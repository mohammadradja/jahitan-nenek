<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Models\Visitor;
use App\Models\AnalyticsEvent;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function user()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)->latest()->paginate(10);
        
        // Dynamic Recommendations: Recommend top-selling products
        $recommendations = Product::orderBy('sales_count', 'desc')->take(3)->get();

        return view('dashboards.user.index', compact('orders', 'recommendations'));
    }

    public function admin()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::whereIn('payment_status', ['unpaid', 'pending'])->count(),
            'total_products' => Product::count(),
            'total_customers' => User::where('role', 'user')->count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
            'revenue_pending' => Order::where('payment_status', 'unpaid')->sum('total_price'),
            'inventory_value' => Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0,
            'new_customers_today' => User::where('role', 'user')->whereDate('created_at', today())->count(),
        ];

        $top_products = Product::orderBy('sales_count', 'desc')->take(5)->get();
        
        $latest_orders = Order::latest()->take(5)->get();
        
        // Chart Data: Orders in last 7 days (Optimized single query)
        $chart_data = ['labels' => [], 'orders' => []];
        $ordersPerDay = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('count', 'date');

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_data['labels'][] = now()->subDays($i)->format('D');
            $chart_data['orders'][] = $ordersPerDay->get($date, 0);
        }

        $analytics = $this->analyticsSummary();

        return view('dashboards.admin.index', compact('stats', 'latest_orders', 'chart_data', 'top_products', 'analytics'));
    }

    public function superadmin()
    {
        $stats = [
            'revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
            'revenue_pending' => Order::where('payment_status', 'unpaid')->sum('total_price'),
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_customers' => User::where('role', 'user')->count(),
            'total_users' => User::count(),
            'total_blogs' => Blog::count(),
            'total_categories' => Category::count(),
            'total_visitors' => Visitor::count(),
            'avg_order_value' => Order::where('payment_status', 'paid')->avg('total_price') ?? 0,
            'low_stock' => Product::where('stock', '<', 5)->count(),
            'inventory_value' => Product::selectRaw('SUM(price * stock) as total')->value('total') ?? 0,
        ];
        
        $latest_orders = Order::latest()->take(5)->get();
        
        // Chart Data: Last 7 days (Optimized single queries)
        $chart_data = ['labels' => [], 'visitors' => [], 'revenue' => [], 'clicks' => []];
        
        $visitorsPerDay = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('count', 'date');
            
        $revenuePerDay = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->where('payment_status', 'paid')
            ->groupBy('date')
            ->pluck('total', 'date');

        $clicksPerDay = AnalyticsEvent::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('event_type', 'click')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('count', 'date');

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_data['labels'][] = now()->subDays($i)->format('d M');
            $chart_data['visitors'][] = $visitorsPerDay->get($date, 0);
            $chart_data['revenue'][] = (float) $revenuePerDay->get($date, 0);
            $chart_data['clicks'][] = $clicksPerDay->get($date, 0);
        }

        $analytics = $this->analyticsSummary();

        return view('dashboards.superadmin.index', compact('stats', 'latest_orders', 'chart_data', 'analytics'));
    }

    private function analyticsSummary(int $days = 30): array
    {
        $start = now()->subDays($days - 1)->startOfDay();

        $impressions = Visitor::where('created_at', '>=', $start)->count();
        $traffic = Visitor::where('created_at', '>=', $start)
            ->select('ip_address', 'user_agent')
            ->distinct()
            ->get()
            ->count();
        $clicks = AnalyticsEvent::where('event_type', 'click')
            ->where('created_at', '>=', $start)
            ->count();

        return [
            'days' => $days,
            'traffic' => $traffic,
            'impressions' => $impressions,
            'clicks' => $clicks,
            'ctr' => $impressions > 0 ? round(($clicks / $impressions) * 100, 2) : 0,
            'average_position' => (float) SiteSetting::get('analytics_average_position', 0),
            'top_paths' => Visitor::select('path', DB::raw('COUNT(*) as views'))
                ->where('created_at', '>=', $start)
                ->groupBy('path')
                ->orderByDesc('views')
                ->take(30)
                ->get()
                ->map(function ($path) {
                    $path->label = $this->trafficPathLabel($path->path);

                    return $path;
                })
                ->groupBy('label')
                ->map(function ($items, $label) {
                    return (object) [
                        'label' => $label,
                        'views' => $items->sum('views'),
                    ];
                })
                ->sortByDesc('views')
                ->values()
                ->take(5),
        ];
    }

    private function trafficPathLabel(?string $path): string
    {
        $path = trim((string) $path, '/');

        if ($path === '') {
            return 'Beranda';
        }

        return match (true) {
            $path === 'blog' || str_starts_with($path, 'blog/') || str_starts_with($path, 'admin/blogs') => 'Artikel',
            str_starts_with($path, 'product/') || str_starts_with($path, 'admin/products') => 'Produk',
            str_starts_with($path, 'admin/categories') => 'Kategori Produk',
            str_starts_with($path, 'admin/orders') => 'Pesanan',
            str_starts_with($path, 'admin/measurements') => 'Ukuran Pelanggan',
            str_starts_with($path, 'admin/cms') || str_starts_with($path, 'superadmin/cms') => 'Kelola Konten',
            str_starts_with($path, 'admin/settings') || str_starts_with($path, 'superadmin/settings') => 'Pengaturan',
            str_starts_with($path, 'admin/reports') || str_starts_with($path, 'superadmin/reports') => 'Laporan',
            str_starts_with($path, 'superadmin/staff') => 'Staf Admin',
            str_starts_with($path, 'superadmin/customers') => 'Data Pelanggan',
            str_starts_with($path, 'cart') => 'Keranjang',
            str_starts_with($path, 'checkout') => 'Checkout',
            str_starts_with($path, 'track-order') => 'Lacak Pesanan',
            str_starts_with($path, 'about') => 'Tentang Kami',
            str_starts_with($path, 'contact') => 'Kontak',
            default => str($path)->replace(['-', '_', '/'], [' ', ' ', ' > '])->title()->toString(),
        };
    }
}

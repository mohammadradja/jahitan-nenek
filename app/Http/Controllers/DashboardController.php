<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Models\Visitor;
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

        return view('dashboards.admin.index', compact('stats', 'latest_orders', 'chart_data', 'top_products'));
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
        $chart_data = ['labels' => [], 'visitors' => [], 'revenue' => []];
        
        $visitorsPerDay = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('count', 'date');
            
        $revenuePerDay = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->where('payment_status', 'paid')
            ->groupBy('date')
            ->pluck('total', 'date');

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_data['labels'][] = now()->subDays($i)->format('d M');
            $chart_data['visitors'][] = $visitorsPerDay->get($date, 0);
            $chart_data['revenue'][] = (float) $revenuePerDay->get($date, 0);
        }

        return view('dashboards.superadmin.index', compact('stats', 'latest_orders', 'chart_data'));
    }
}

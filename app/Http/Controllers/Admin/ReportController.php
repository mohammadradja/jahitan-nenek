<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', now()->endOfDay()->toDateString());

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->get();

        $stats = [
            'total_sales' => $orders->count(),
            'total_revenue' => $orders->sum('total_price'),
            'avg_ticket' => $orders->avg('total_price') ?? 0,
        ];

        return view('admin.reports.sales', compact('stats', 'orders', 'startDate', 'endDate'));
    }

    public function stock(Request $request)
    {
        $products = Product::with('category')->get();
        
        $stats = [
            'total_items' => $products->sum('stock'),
            'total_value' => $products->sum(fn($p) => $p->price * $p->stock),
            'low_stock_count' => $products->where('stock', '<', 5)->count(),
        ];

        return view('admin.reports.stock', compact('products', 'stats'));
    }

    public function customers(Request $request)
    {
        $customers = User::where('role', 'user')
            ->withCount(['orders' => function($q) {
                $q->where('payment_status', 'paid');
            }])
            ->withSum(['orders' => function($q) {
                $q->where('payment_status', 'paid');
            }], 'total_price')
            ->orderBy('orders_sum_total_price', 'desc')
            ->paginate(15);

        $totalCustomers = User::where('role', 'user')->count();
        $customersWithOrders = User::where('role', 'user')->has('orders')->count();
        
        $stats = [
            'avg_clv' => Order::where('payment_status', 'paid')->sum('total_price') / max($totalCustomers, 1),
            'retention_rate' => ($customersWithOrders / max($totalCustomers, 1)) * 100,
            'total_loyal_customers' => User::where('role', 'user')->where('loyalty_points', '>', 100)->count(),
        ];

        return view('admin.reports.customers', compact('customers', 'stats'));
    }

    public function finance(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->get('end_date', now()->endOfDay()->toDateString());

        $orders = Order::whereBetween('created_at', [
                $startDate . ' 00:00:00', 
                $endDate . ' 23:59:59'
            ])
            ->where('payment_status', 'paid')
            ->get();

        $stats = [
            'gross_revenue' => $orders->sum('total_price'),
            'shipping_cost' => $orders->sum('shipping_cost'),
            'net_revenue' => $orders->sum(fn($o) => $o->total_price - $o->shipping_cost),
        ];

        return view('admin.reports.finance', compact('stats', 'orders', 'startDate', 'endDate'));
    }
}

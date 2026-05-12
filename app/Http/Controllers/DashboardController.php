<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('dashboards.user.index', compact('orders'));
    }

    public function admin()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::whereIn('payment_status', ['unpaid', 'pending'])->count(),
            'total_products' => Product::count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
        ];
        
        $latest_orders = Order::latest()->take(5)->get();
        
        // Chart Data: Orders in last 7 days
        $chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_data['labels'][] = now()->subDays($i)->format('D');
            $chart_data['orders'][] = Order::whereDate('created_at', $date)->count();
        }

        return view('dashboards.admin.index', compact('stats', 'latest_orders', 'chart_data'));
    }

    public function superadmin()
    {
        $stats = [
            'revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
            'total_users' => \App\Models\User::count(),
            'total_blogs' => Blog::count(),
            'total_categories' => Category::count(),
        ];
        
        $latest_orders = Order::latest()->take(10)->get();
        
        // Visitor Chart: Last 7 days
        $chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_data['labels'][] = now()->subDays($i)->format('d M');
            $chart_data['visitors'][] = \App\Models\Visitor::whereDate('created_at', $date)->count();
            $chart_data['revenue'][] = Order::whereDate('created_at', $date)->where('payment_status', 'paid')->sum('total_price');
        }

        return view('dashboards.superadmin.index', compact('stats', 'latest_orders', 'chart_data'));
    }
}

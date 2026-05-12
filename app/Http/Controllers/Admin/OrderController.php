<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = \App\Models\Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = \App\Models\Order::with(['user', 'items.product', 'productionStages'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number,
        ]);

        if ($request->status === 'shipped') {
            $order->update(['shipped_at' => now()]);
        } elseif ($request->status === 'completed') {
            $order->update(['completed_at' => now()]);
        }

        // Notify Customer
        try {
            $wa = new \App\Services\WhatsAppService();
            $wa->sendOrderStatusUpdate($order);
            
            \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderReceipt($order));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Notification failed: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function approve(string $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->approve();

        // Notify Customer
        try {
            $wa = new \App\Services\WhatsAppService();
            $wa->sendOrderStatusUpdate($order);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("WhatsApp Notification failed: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pembayaran pesanan berhasil dikonfirmasi secara manual.');
    }

    public function reject(string $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->reject();

        return redirect()->back()->with('success', 'Pesanan berhasil ditolak/dibatalkan.');
    }
}

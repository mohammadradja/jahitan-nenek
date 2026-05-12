<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'invoice_number', 'customer_name', 'customer_email', 'customer_phone', 
        'customer_address', 'total_price', 'shipping_cost', 'status', 'shipping_status',
        'payment_status', 'payment_method', 'courier', 'tracking_number', 
        'snap_token', 'notes', 'paid_at', 'shipped_at', 'completed_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function productionStages()
    {
        return $this->hasMany(ProductionStage::class);
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
    }

    public function markAsShipped()
    {
        $this->update(['status' => 'shipped']);
    }

    public function markAsCancelled()
    {
        $this->update(['status' => 'cancelled', 'payment_status' => 'cancelled']);
    }

    public function approve()
    {
        $this->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
    }

    public function reject()
    {
        $this->update([
            'payment_status' => 'rejected',
            'status' => 'cancelled',
        ]);
    }
}

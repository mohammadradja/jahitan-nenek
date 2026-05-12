<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Poppins', sans-serif; color: #2E2A27; background-color: #F8F3EC; margin: 0; padding: 40px; }
        .container { max-width: 600px; background-color: #ffffff; padding: 40px; border-radius: 32px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); margin: 0 auto; }
        .header { text-align: center; margin-bottom: 40px; }
        .header h1 { font-family: 'Playfair Display', serif; color: #D8A7B1; font-size: 32px; margin: 0; }
        .content { line-height: 1.6; }
        .order-details { margin: 30px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0; }
        .item { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .total { font-weight: bold; font-size: 18px; margin-top: 20px; text-align: right; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #aaa; text-transform: uppercase; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Jahitan Nenek</h1>
        </div>
        <div class="content">
            <p>Halo {{ $order->customer_name }},</p>
            <p>Terima kasih telah berbelanja di Jahitan Nenek. Pesanan Anda telah kami terima dan sedang diproses.</p>
            
            <div class="order-details">
                <p><strong>Invoice:</strong> #{{ $order->invoice_number }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                
                <div style="margin-top: 20px;">
                    @foreach($order->items as $item)
                        <div class="item">
                            <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                            <span>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                
                <div class="total">
                    Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}
                </div>
            </div>
            
            <p>Kami akan memberikan update jika status pesanan Anda berubah.</p>
        </div>
        <div class="footer">
            🧵 Crafting with Love since 1970
        </div>
    </div>
</body>
</html>

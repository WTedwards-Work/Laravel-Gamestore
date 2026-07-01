<div style="max-width:900px; margin:30px auto; font-family:Arial, sans-serif;">

    <h1 style="text-align:center;">Your Cart</h1>

    <div style="text-align:center; margin-bottom:25px;">
        <a href="/products" style="padding:10px 18px; background:#333; color:white; border-radius:6px; text-decoration:none;">
            ← Back to Store
        </a>
    </div>

    @php $total = 0; @endphp

    @if(empty($items))
        <p style="text-align:center; font-size:18px;">Your cart is empty.</p>
    @else

        @foreach($items as $item)
            @php
                $total += $item->subtotal;
            @endphp

            <div style="display:flex; align-items:center; gap:20px; border:1px solid #ddd; border-radius:12px; padding:18px; margin-bottom:15px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                
                <img 
                    src="{{ asset('images/' . $item->image) }}" 
                    style="width:110px; height:110px; object-fit:cover; border-radius:8px;"
                >

                <div style="flex:1;">
                    <h3 style="margin:0 0 8px;">{{ $item->name }}</h3>
                    <p><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                    <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                    <p><strong>Subtotal:</strong> ${{ number_format($item->subtotal, 2) }}</p>

                    <div style="margin-top:10px;">
                        <a href="/cart/increase/{{ $item->product_id }}" style="margin-right:10px; text-decoration:none;">➕</a>
                        <a href="/cart/decrease/{{ $item->product_id }}" style="margin-right:10px; text-decoration:none;">➖</a>
                        <a href="/cart/remove/{{ $item->product_id }}" style="color:#c0392b;">Remove</a>
                    </div>
                </div>
            </div>
        @endforeach

        <h2 style="text-align:center; margin-top:25px;">Total: ${{ number_format($total, 2) }}</h2>

        <div style="margin:30px auto; max-width:500px; border:1px solid #ddd; border-radius:12px; padding:25px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="text-align:center; margin-top:0;">Shipping Information</h2>

            <form method="GET" action="/checkout">
                <label>Full Name</label>
                <input type="text" name="shipping_name" required style="width:100%; padding:10px; margin:6px 0 15px; border:1px solid #ccc; border-radius:6px;">

                <label>Street Address</label>
                <input type="text" name="shipping_address" required style="width:100%; padding:10px; margin:6px 0 15px; border:1px solid #ccc; border-radius:6px;">

                <label>City</label>
                <input type="text" name="shipping_city" required style="width:100%; padding:10px; margin:6px 0 15px; border:1px solid #ccc; border-radius:6px;">

                <label>State</label>
                <input type="text" name="shipping_state" required style="width:100%; padding:10px; margin:6px 0 15px; border:1px solid #ccc; border-radius:6px;">

                <label>ZIP Code</label>
                <input type="text" name="shipping_zip" required style="width:100%; padding:10px; margin:6px 0 20px; border:1px solid #ccc; border-radius:6px;">

                <button type="submit" style="width:100%; padding:14px; background:#28a745; color:white; border:none; border-radius:8px; font-size:18px; font-weight:bold; cursor:pointer;">
                    Place Order
                </button>
            </form>
        </div>

    @endif

</div>
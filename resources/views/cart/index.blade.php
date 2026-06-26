<h1 style="text-align:center;">Your Cart</h1>

<div style="text-align:center; margin-bottom:20px;">
    <a href="/products" style="
        padding:8px 15px;
        background:#333;
        color:white;
        border-radius:5px;
        text-decoration:none;
    ">
        ← Back to Store
    </a>
</div>

@php $total = 0; @endphp

@if(empty($cart))
    <p style="text-align:center;">Your cart is empty.</p>
@else

    @foreach($products as $product)
        @php
            $subtotal = $product->price * $cart[$product->id];
            $total += $subtotal;
        @endphp

        <div style="
            border:1px solid #ccc;
            border-radius:10px;
            padding:15px;
            margin:15px auto;
            width:300px;
            text-align:center;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        ">
            
            <h3>{{ $product->name }}</h3>

            <img 
                src="{{ asset('images/' . $product->image) }}" 
                style="width:100px; height:100px; object-fit:cover; border-radius:5px;"
            ><br><br>

            <p><strong>Price:</strong> ${{ $product->price }}</p>

            <p><strong>Quantity:</strong> {{ $cart[$product->id] }}</p>

            <p><strong>Subtotal:</strong> ${{ $subtotal }}</p>

            {{-- Controls --}}
            <div style="margin-top:10px;">
                <a href="/cart/increase/{{ $product->id }}">➕</a>
                <a href="/cart/decrease/{{ $product->id }}">➖</a>
                <a href="/cart/remove/{{ $product->id }}">Remove</a>
            </div>

        </div>
    @endforeach

    <h2 style="text-align:center;">Total: ${{ $total }}</h2>

    {{-- ✅ CHECKOUT BUTTON --}}
    <div style="text-align:center; margin-top:20px;">
        <a href="/checkout" style="
            padding:12px 25px;
            background:#28a745;
            color:white;
            border-radius:8px;
            text-decoration:none;
            font-size:18px;
            font-weight:bold;
        ">
            Checkout
        </a>
    </div>

@endif
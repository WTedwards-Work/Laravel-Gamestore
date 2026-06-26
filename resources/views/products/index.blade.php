<h1 style="text-align:center;">Game Store Products</h1>

{{-- Success message --}}
@if(session('success'))
    <p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif

{{-- NAV BAR --}}
<div style="
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:20px;
">

    <a href="/products" style="
        padding:8px 15px;
        background:#333;
        color:white;
        border-radius:5px;
        text-decoration:none;
    ">Store</a>

    <a href="/cart" style="
        padding:8px 15px;
        background:#007bff;
        color:white;
        border-radius:5px;
        text-decoration:none;
    ">Cart</a>

    <a href="/admin/products" style="
        padding:8px 15px;
        background:#28a745;
        color:white;
        border-radius:5px;
        text-decoration:none;
    ">Admin</a>

</div>

{{-- GRID CONTAINER --}}
<div style="
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
">

@foreach($products as $product)

    {{-- PRODUCT CARD --}}
    <div style="
        border:1px solid #ccc;
        border-radius:10px;
        padding:15px;
        text-align:center;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
        background:white;
    ">

        <img 
            src="{{ asset('images/' . $product->image) }}" 
            style="width:100%; height:200px; object-fit:cover; border-radius:8px;"
        >

        <h3 style="margin-top:10px;">{{ $product->name }}</h3>

        <p><strong>${{ $product->price }}</strong></p>

        <p style="font-size:14px; color:gray;">
            {{ $product->description }}
        </p>

        <form action="/cart/add/{{ $product->id }}" method="POST">
            @csrf
            <button style="
                background:#007bff;
                color:white;
                border:none;
                padding:8px 12px;
                border-radius:5px;
                cursor:pointer;
            ">
                Add to Cart
            </button>
        </form>

    </div>

@endforeach

</div>
<h1 style="text-align:center;">Admin Product Management</h1>

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
    ">← Back to Store</a>

    <a href="/admin/products/create" style="
        padding:8px 15px;
        background:#28a745;
        color:white;
        border-radius:5px;
        text-decoration:none;
    ">+ Add Product</a>

</div>

@if(session('success'))
    <p style="color:green; text-align:center;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" style="margin:auto; border-collapse:collapse;">

    <tr style="background:#f2f2f2;">
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

@foreach($products as $product)
<tr>
    <td>{{ $product->name }}</td>
    <td>${{ $product->price }}</td>
    <td>{{ $product->stock }}</td>

    <td>
        <a href="/admin/products/{{ $product->id }}/edit">Edit</a>

        <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach

</table>
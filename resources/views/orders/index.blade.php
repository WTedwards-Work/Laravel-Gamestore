<h1 style="text-align:center;">Your Orders</h1>

@if(session('success'))
    <p style="color:green; text-align:center;">
        {{ session('success') }}
    </p>
@endif

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

<table border="1" cellpadding="10" style="margin:auto; border-collapse:collapse;">

    <tr style="background:#f2f2f2;">
        <th>Order ID</th>
        <th>Total</th>
        <th>Date</th>
    </tr>

@foreach($orders as $order)
<tr>
    <td>{{ $order->id }}</td>
    <td>${{ $order->total_price }}</td>
    <td>{{ $order->order_date }}</td>
</tr>
@endforeach

</table>
<h1>Add Product</h1>

<form action="/admin/products" method="POST">
    @csrf

    SKU: <input type="text" name="sku"><br><br>

    Name: <input type="text" name="name"><br><br>

    Description: <input type="text" name="description"><br><br>

    Price: <input type="text" name="price"><br><br>

    Image filename: <input type="text" name="image">
    <small>(example: cod.jpg)</small><br><br>

    Stock: <input type="number" name="stock"><br><br>

    <button type="submit">Create Product</button>
</form>
<h1>Edit Product</h1>

<form action="/admin/products/{{ $product->id }}" method="POST">
    @csrf
    @method('PUT')

    SKU: <input type="text" name="sku" value="{{ $product->sku }}"><br><br>

    Name: <input type="text" name="name" value="{{ $product->name }}"><br><br>

    Description: <input type="text" name="description" value="{{ $product->description }}"><br><br>

    Price: <input type="text" name="price" value="{{ $product->price }}"><br><br>

    Image filename: <input type="text" name="image" value="{{ $product->image }}"><br><br>

    Stock: <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <button type="submit">Update Product</button>
</form>
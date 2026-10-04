<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;">
        <?= session()->getFlashdata('error') ?>
    </p>
<?php endif; ?>

<form
    action="<?= base_url('/products/update/' . $product['id']) ?>"
    method="post"
    enctype="multipart/form-data"
>

    <label>Product Name:</label>
    <input
        type="text"
        name="name"
        value="<?= esc(old('name', $product['name'])) ?>"
        required
    >

    <br><br>

    <label>Price:</label>
    <input
        type="number"
        name="price"
        step="0.01"
        min="0"
        value="<?= esc(old('price', $product['price'])) ?>"
        required
    >

    <br><br>

    <label>Stock Quantity:</label>
    <input
        type="number"
        name="stock_quantity"
        min="0"
        value="<?= esc(old('stock_quantity', $product['stock_quantity'])) ?>"
        required
    >

    <br><br>

    <?php if (!empty($product['image'])): ?>

        <p>Current Image:</p>

        <img
            src="<?= base_url('uploads/products/' . $product['image']) ?>"
            width="120"
            alt="<?= esc($product['name']) ?>"
        >

        <br><br>

    <?php endif; ?>

    <label>Replace Image:</label>
    <input
        type="file"
        name="image"
        accept="image/jpeg,image/png,image/webp"
    >

    <br><br>

    <button type="submit">Update Product</button>

</form>

<br>

<a href="<?= base_url('/products') ?>">Back to Products</a>

</body>
</html>
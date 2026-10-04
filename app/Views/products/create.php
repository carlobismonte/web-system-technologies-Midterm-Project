<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>

<h1>Add New Product</h1>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;">
        <?= session()->getFlashdata('error') ?>
    </p>
<?php endif; ?>

<form action="<?= base_url('/products/store') ?>" method="post" enctype="multipart/form-data">

    <label for="name">Product Name:</label>
    <input
        type="text"
        name="name"
        id="name"
        value="<?= old('name') ?>"
        required
    >

    <br><br>

    <label for="price">Price:</label>
    <input
        type="number"
        name="price"
        id="price"
        step="0.01"
        min="0"
        value="<?= old('price') ?>"
        required
    >

    <br><br>

    <label for="stock_quantity">Stock Quantity:</label>
    <input
        type="number"
        name="stock_quantity"
        id="stock_quantity"
        min="0"
        value="<?= old('stock_quantity') ?>"
        required
    >

    <br><br>

    <label for="image">Product Image:</label>
    <input
        type="file"
        name="image"
        id="image"
        accept="image/jpeg,image/png,image/webp"
    >

    <br><br>

    <button type="submit">Save Product</button>

</form>

<br>

<a href="<?= base_url('/products') ?>">Back to Products</a>

</body>
</html>
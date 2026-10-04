<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Record Sale</title>
</head>
<body>

    <h1>Record Sale</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;">
            <?= esc(session()->getFlashdata('success')) ?>
        </p>
    <?php endif; ?>

    <form action="<?= base_url('/sales') ?>" method="post">

        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" required>
            <option value="">-- Select Product --</option>

            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>">
                    <?= esc($product['name']) ?>
                    - ₱<?= number_format($product['price'], 2) ?>
                    (Stock: <?= $product['stock_quantity'] ?>)
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="customer_id">Customer:</label>
        <select name="customer_id" id="customer_id">
            <option value="">-- Walk-in Customer --</option>

            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= esc($customer['full_name']) ?>
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <label for="quantity">Quantity:</label>
        <input
            type="number"
            name="quantity"
            id="quantity"
            min="1"
            required
        >

        <br><br>

        <button type="submit">Record Sale</button>

    </form>

    <br>

    <a href="<?= base_url('/users') ?>">Back</a>

</body>
</html>
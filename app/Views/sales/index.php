<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales History</title>
</head>
<body>

<h1>Sales History</h1>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;">
        <?= esc(session()->getFlashdata('success')) ?>
    </p>
<?php endif; ?>

<a href="<?= base_url('/') ?>">Home</a> |
<a href="<?= base_url('/users') ?>">Back</a>

<p>
    <a href="<?= base_url('/sales/new') ?>">Record New Sale</a>
</p>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Staff</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>

    <?php if (empty($sales)): ?>

        <tr>
            <td colspan="7">No sales recorded yet.</td>
        </tr>

    <?php else: ?>

        <?php foreach ($sales as $sale): ?>
            <tr>
                <td><?= $sale['id'] ?></td>

                <td>
                    <?= esc($sale['product_name']) ?>
                </td>

                <td>
                    <?= $sale['customer_name']
                        ? esc($sale['customer_name'])
                        : 'Walk-in Customer' ?>
                </td>

                <td>
                    <?= esc($sale['staff_name']) ?>
                </td>

                <td>
                    <?= $sale['quantity'] ?>
                </td>

                <td>
                    ₱<?= number_format($sale['total_price'], 2) ?>
                </td>

                <td>
                    <?= esc($sale['created_at']) ?>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>
</table>

<br>


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>

<h1>Products</h1>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;">
        <?= esc(session()->getFlashdata('success')) ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;">
        <?= esc(session()->getFlashdata('error')) ?>
    </p>
<?php endif; ?>

<a href="<?= base_url('/sales') ?>">Sales History</a> |
<a href="<?= base_url('/users') ?>">Users</a> |
<a href="<?= base_url('/') ?>">Home</a> |

<p>
    <a href="<?= base_url('/products/new') ?>">Add New Product</a>
</p>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php if (empty($products)): ?>

        <tr>
            <td colspan="7">No products found.</td>
        </tr>

    <?php else: ?>

        <?php foreach ($products as $product): ?>

            <tr>
                <td><?= $product['id'] ?></td>

                <td>
                    <?php if (!empty($product['image'])): ?>
                        <img
                            src="<?= base_url('uploads/products/' . $product['image']) ?>"
                            alt="<?= esc($product['name']) ?>"
                            width="80"
                        >
                    <?php else: ?>
                        No image
                    <?php endif; ?>
                </td>

                <td><?= esc($product['name']) ?></td>

                <td>
                    ₱<?= number_format($product['price'], 2) ?>
                </td>

                <td><?= $product['stock_quantity'] ?></td>

                <td><?= esc($product['created_at']) ?></td>

                <td>
                    <a href="<?= base_url('/products/edit/' . $product['id']) ?>">
                        Edit
                    </a>

                    |

                    <a
                        href="<?= base_url('/products/delete/' . $product['id']) ?>"
                        onclick="return confirm('Are you sure you want to delete this product?')"
                    >
                        Delete
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>
</table>

<br>



</body>
</html>
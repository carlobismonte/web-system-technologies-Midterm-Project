<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point-of-Sale System</title>
</head>
<body>

<h1>Point-of-Sale System</h1>

<p>Today's Date: <?= date('Y-m-d') ?></p>

<h2>POS Navigation</h2>

<p>
    <a href="<?= base_url('/products') ?>">Products</a> |
    <a href="<?= base_url('/customers') ?>">Customer Accounts</a> |
    <a href="<?= base_url('/users') ?>">User Accounts</a> |
    <a href="<?= base_url('/sales/new') ?>">Record Sale</a> |
    <a href="<?= base_url('/sales') ?>">Sales History</a>
</p>

<hr>

<p>
    Logged in as:
    <strong><?= esc(session()->get('username')) ?></strong>
</p>

<a href="<?= base_url('/about') ?>">About</a> |
<a href="<?= base_url('/logout') ?>">Logout</a>

</body>
</html>
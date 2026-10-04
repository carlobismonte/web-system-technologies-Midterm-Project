<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
</head>
<body>

<h1>Add Customer</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/customers/store" method="post">

    <label>Full Name:</label>
    <input
        type="text"
        name="full_name"
        value="<?= old('full_name', $data['full_name'] ?? '') ?>"
    >
    <br><br>

    <label>Email:</label>
    <input
        type="email"
        name="email"
        value="<?= old('email', $data['email'] ?? '') ?>"
    >
    <br><br>

    <label>Phone:</label>
    <input
        type="text"
        name="phone"
        value="<?= old('phone', $data['phone'] ?? '') ?>"
    >
    <br><br>

    <button type="submit">Add Customer</button>

</form>

<br>

<a href="/customers">Back to Customers</a>

</body>
</html>
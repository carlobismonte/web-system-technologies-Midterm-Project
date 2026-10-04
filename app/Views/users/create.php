<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
</head>
<body>

<h1>Add User</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/users/store" method="post">

    <label>Username:</label>
    <input
        type="text"
        name="username"
        value="<?= old('username', $data['username'] ?? '') ?>"
    >
    <br><br>

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

    <button type="submit">Add User</button>

</form>

<br>

<a href="/users">Back to Users</a>

</body>
</html>
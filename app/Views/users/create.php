<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
</head>
<body>

<h1>Add New User</h1>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form
    action="<?= base_url('/users/store') ?>"
    method="post"
    enctype="multipart/form-data"
>

    <?= csrf_field() ?>

    <label for="username">Username:</label>
    <input
        type="text"
        name="username"
        id="username"
        value="<?= esc(old('username', $data['username'] ?? '')) ?>"
        required
    >

    <br><br>

    <label for="full_name">Full Name:</label>
    <input
        type="text"
        name="full_name"
        id="full_name"
        value="<?= esc(old('full_name', $data['full_name'] ?? '')) ?>"
        required
    >

    <br><br>

    <label for="email">Email:</label>
    <input
        type="email"
        name="email"
        id="email"
        value="<?= esc(old('email', $data['email'] ?? '')) ?>"
        required
    >

    <br><br>

    <label for="password">Password:</label>
    <input
        type="password"
        name="password"
        id="password"
        required
    >

    <br><br>

    <label for="avatar">Avatar:</label>
    <input
        type="file"
        name="avatar"
        id="avatar"
        accept="image/jpeg,image/png"
    >

    <br><br>

    <button type="submit">Add User</button>

</form>

<br>

<a href="<?= base_url('/users') ?>">Back to Users</a>

</body>
</html>
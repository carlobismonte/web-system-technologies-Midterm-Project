<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/users/update/<?= esc($user['id']) ?>" method="post" enctype="multipart/form-data">

    <label>Username:</label>
    <input
        type="text"
        name="username"
        value="<?= old('username', $user['username'] ?? '') ?>"
    >

    <br><br>

    <label>Full Name:</label>
    <input
        type="text"
        name="full_name"
        value="<?= old('full_name', $user['full_name'] ?? '') ?>"
    >

    <br><br>

    <label>Email:</label>
    <input
        type="email"
        name="email"
        value="<?= old('email', $user['email'] ?? '') ?>"
    >

    <label>Profile Picture:</label>
    <input
        type="file"
        name="avatar"
        accept=".jpg,.jpeg,.png"
    >

    <br><br>

    <button type="submit">Update User</button>

</form>

<br>

<a href="/users">Back to Users</a>

</body>
</html>
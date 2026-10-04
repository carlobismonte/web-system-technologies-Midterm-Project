<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="/login/authenticate" method="post">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <br><br>

        <button type="submit">Login</button>

    </form>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<h1>Profile</h1>

<?php if ($user): ?>

    <p><strong>ID:</strong> <?= esc($user['id']) ?></p>
    <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
    <p><strong>Full Name:</strong> <?= esc($user['full_name']) ?></p>
    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
    <p><strong>Created At:</strong> <?= esc($user['created_at']) ?></p>

<?php else: ?>

    <p>No user found.</p>

<?php endif; ?>

<br>

<a href="/">Today</a> |
<a href="/tasks">Tasks</a> |
<a href="/about">About</a>

</body>
</html>
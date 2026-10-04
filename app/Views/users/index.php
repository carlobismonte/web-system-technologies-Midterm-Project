<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Accounts</title>
</head>
<body>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a> |
        <a href="/logout">Logout</a>
    </nav>

    <h1>User Accounts</h1>

    <a href="/users/new">Add New User</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['id']) ?></td>

                <td>
                    <?php if (!empty($user['avatar'])): ?>
                        <img
                            src="/uploads/avatars/<?= esc($user['avatar']) ?>"
                            alt="Avatar"
                            width="100"
                            height="100"
                        >
                    <?php else: ?>
                        <img
                            src="/uploads/avatars/placeholder.png"
                            alt="No Avatar"
                            width="100"
                            height="100"
                        >
                    <?php endif; ?>
                </td>

                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['created_at']) ?></td>

                <td>
                    <a href="/users/edit/<?= esc($user['id']) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
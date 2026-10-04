<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
</head>
<body>

<h1>Task List</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>
        <th>Task Date</th>
        <th>Created At</th>
    </tr>

    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= esc($task['id']) ?></td>
            <td><?= esc($task['title']) ?></td>
            <td><?= esc($task['status']) ?></td>
            <td><?= esc($task['task_date']) ?></td>
            <td><?= esc($task['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<br>

<a href="/">Today</a> |
<a href="/profile">Profile</a> |
<a href="/about">About</a>

</body>
</html>
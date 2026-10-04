<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tasks for Today</title>
</head>
<body>

<h1>Tasks for Today</h1>

<p>Today's Date: <?= date('Y-m-d') ?></p>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= esc($task['id']) ?></td>
            <td><?= esc($task['title']) ?></td>
            <td><?= esc($task['status']) ?></td>
            <td><?= esc($task['task_date']) ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<br>

<a href="/tasks">View All Tasks</a> |
<a href="/profile">Profile</a> |
<a href="/about">About</a> |
<a href="/customers">Customer Accounts</a> |
<a href="/users">User Accounts</a>

</body>
</html>
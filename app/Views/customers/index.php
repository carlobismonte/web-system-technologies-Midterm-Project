<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Accounts</title>
</head>
<body>
    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>
    </nav>

    <h1>Customer Accounts</h1>
    
    <a href="/customers/new">Add New Customer</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>created_at</th>
            <th colspan="2">Action</th>
        </tr>

        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['id']) ?></td>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
                <td><?= esc($customer['created_at']) ?></td>
                <td><a href="/customers/edit/<?= esc($customer['id']) ?>">Edit</a></td>
                <td><a href="<?= base_url('/customers/delete/' . $customer['id']) ?>"
                   onclick="return confirm('Are you sure you want to delete this customer?')">
                    Delete
                </a></td>
                
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
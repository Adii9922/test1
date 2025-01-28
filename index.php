<?php
include 'db.php';

// Ambil data pegawai
$stmt = $pdo->query("SELECT employees.*, departments.name AS department_name FROM employees LEFT JOIN departments ON employees.department_id = departments.id");
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Employee Management</h1>
    <a href="create.php">Add Employee</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= $employee['id'] ?></td>
            <td><?= $employee['name'] ?></td>
            <td><?= $employee['position'] ?></td>
            <td><?= $employee['salary'] ?></td>
            <td><?= $employee['department_name'] ?></td>
            <td>
                <a href="update.php?id=<?= $employee['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $employee['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $department_id = $_POST['department_id'];

    $stmt = $pdo->prepare("UPDATE employees SET name = ?, position = ?, salary = ?, department_id = ? WHERE id = ?");
    $stmt->execute([$name, $position, $salary, $department_id, $id]);

    header("Location: index.php");
}

$departments = $pdo->query("SELECT * FROM departments")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $employee['name'] ?>" required>
        <label>Position:</label>
        <select name="position" required>
            <option value="manager" <?= $employee['position'] == 'manager' ? 'selected' : '' ?>>Manager</option>
            <option value="staff" <?= $employee['position'] == 'staff' ? 'selected' : '' ?>>Staff</option>
            <option value="admin" <?= $employee['position'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <label>Salary:</label>
        <input type="number" name="salary" value="<?= $employee['salary'] ?>" required>
        <label>Department:</label>
        <select name="department_id" required>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['id'] ?>" <?= $department['id'] == $employee['department_id'] ? 'selected' : '' ?>><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Update Employee</button>
    </form>
    <a href="index.php">Back to Employee List</a>
</body>
</html>
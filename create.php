<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $department_id = $_POST['department_id'];

    $stmt = $pdo->prepare("INSERT INTO employees (name, position, salary, department_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $position, $salary, $department_id]);

    header("Location: index.php");
}

$departments = $pdo->query("SELECT * FROM departments")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Position:</label>
        <select name ="position" required>
            <option value="manager">Manager</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <label>Salary:</label>
        <input type="number" name="salary" required>
        <label>Department:</label>
        <select name="department_id" required>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Employee</button>
    </form>
    <a href="index.php">Back to Employee List</a>
</body>
</html>
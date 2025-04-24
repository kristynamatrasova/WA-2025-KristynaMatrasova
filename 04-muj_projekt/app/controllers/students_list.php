<?php
require_once '../models/Database.php';
require_once '../models/Student.php';

// Vytvoření instance modelu pro Student
$db = (new Database())->getConnection();
$studentModel = new Student($db);

// Získání seznamu studentů
$students = $studentModel->getAll();
?>

<h1>Seznam studentů</h1>
<a href="student_create.php">Přidat nového studenta</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>Email</th>
            <th>Obor</th>
            <th>Akce</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['first_name']; ?></td>
                <td><?php echo $student['last_name']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['course']; ?></td>
                <td>
                    <a href="student_edit.php?id=<?php echo $student['id']; ?>">Upravit</a> | 
                    <a href="student_delete.php?id=<?php echo $student['id']; ?>">Smazat</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

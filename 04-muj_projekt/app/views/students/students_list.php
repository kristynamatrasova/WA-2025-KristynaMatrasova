<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Seznam studentů</title>
</head>
<body>
    <h1>Seznam studentů</h1>
    <a href="student_form.php">+ Přidat studenta</a><br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Email</th>
            <th>Obor</th>
            <th>Akce</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></td>
            <td><?= htmlspecialchars($student['email']) ?></td>
            <td><?= htmlspecialchars($student['course']) ?></td>
            <td>
                <a href="../../controllers/student_edit.php?id=<?= $student['id'] ?>">Upravit</a> |
                <a href="../../controllers/student_delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Opravdu smazat?')">Smazat</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

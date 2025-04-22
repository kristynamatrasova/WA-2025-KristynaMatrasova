<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Formulář pro studenta</title>
</head>
<body>
    <h1>Formulář pro studenta</h1>
    <form action="../../controllers/student_create.php" method="POST">
        <label>Jméno:</label><br>
        <input type="text" name="first_name" required><br>

        <label>Příjmení:</label><br>
        <input type="text" name="last_name" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Datum narození:</label><br>
        <input type="date" name="dob" required><br>

        <label>Obor:</label><br>
        <input type="text" name="course"><br><br>

        <input type="submit" value="Uložit">
    </form>
</body>
</html>

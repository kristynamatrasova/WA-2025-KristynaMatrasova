<?php
require_once '../models/Database.php';
require_once '../models/Student.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $dob = htmlspecialchars($_POST['dob']);
    $course = htmlspecialchars($_POST['course']);

    // Vytvoření instance modelu pro Student
    $db = (new Database())->getConnection();
    $studentModel = new Student($db);

    // Vložení nového studenta do DB
    if ($studentModel->create($firstName, $lastName, $email, $dob, $course)) {
        // Přesměrování na seznam studentů
        header("Location: students_list.php");
        exit();
    } else {
        echo "Chyba při přidávání studenta.";
    }
}
?>

<!-- HTML formulář pro vytvoření studenta -->
<h1>Přidat nového studenta</h1>
<form method="POST" action="student_create.php">
    <label for="first_name">Křestní jméno:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Příjmení:</label>
    <input type="text" name="last_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="dob">Datum narození:</label>
    <input type="date" name="dob" required><br>

    <label for="course">Obor:</label>
    <input type="text" name="course"><br>

    <input type="submit" value="Přidat studenta">
</form>

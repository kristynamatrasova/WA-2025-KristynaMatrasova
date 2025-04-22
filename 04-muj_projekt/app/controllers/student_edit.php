<?php
require_once '../models/Database.php';
require_once '../models/Student.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Vytvoření instance modelu pro Student
    $db = (new Database())->getConnection();
    $studentModel = new Student($db);

    // Načtení dat studenta
    $student = $studentModel->getById($id);

    if ($student) {
        // Zpracování formuláře pro aktualizaci
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $email = htmlspecialchars($_POST['email']);
            $dob = htmlspecialchars($_POST['dob']);
            $course = htmlspecialchars($_POST['course']);

            if ($studentModel->update($id, $firstName, $lastName, $email, $dob, $course)) {
                // Přesměrování na seznam studentů
                header("Location: students_list.php");
                exit();
            } else {
                echo "Chyba při aktualizaci studenta.";
            }
        }
    } else {
        echo "Student nenalezen.";
    }
} else {
    echo "Neplatný požadavek.";
}
?>

<!-- HTML formulář pro úpravu studenta -->
<h1>Upravit studenta</h1>
<form method="POST" action="student_edit.php?id=<?php echo $student['id']; ?>">
    <label for="first_name">Křestní jméno:</label>
    <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>" required><br>

    <label for="last_name">Příjmení:</label>
    <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>

    <label for="dob">Datum narození:</label>
    <input type="date" name="dob" value="<?php echo $student['dob']; ?>" required><br>

    <label for="course">Obor:</label>
    <input type="text" name="course" value="<?php echo $student['course']; ?>"><br>

    <input type="submit" value="Upravit studenta">
</form>

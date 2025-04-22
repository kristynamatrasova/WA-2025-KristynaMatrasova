<?php
require_once '../models/Database.php';
require_once '../models/Student.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Vytvoření instance modelu pro Student
    $db = (new Database())->getConnection();
    $studentModel = new Student($db);

    // Smazání studenta
    if ($studentModel->delete($id)) {
        // Přesměrování na seznam studentů
        header("Location: students_list.php");
        exit();
    } else {
        echo "Chyba při mazání studenta.";
    }
} else {
    echo "Neplatný požadavek.";
}

<?php
require_once '../models/Database.php';
require_once '../models/Student.php';

class StudentController {
    private $db;
    private $studentModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->studentModel = new Student($this->db);
    }

    public function createStudent() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $birthDate = htmlspecialchars($_POST['birth_date']);
            $class = htmlspecialchars($_POST['class']);
            $email = htmlspecialchars($_POST['email']);
            $phone = !empty($_POST['phone']) ? htmlspecialchars($_POST['phone']) : null;

            // Zpracování nahraných profilových obrázků (pokud jsou)
            $imagePath = null;
            if (!empty($_FILES['profile_image']['name'])) {
                $uploadDir = '../public/images/';
                $filename = basename($_FILES['profile_image']['name']);
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
                    $imagePath = '/public/images/' . $filename; // Relativní cesta
                }
            }

            // Uložení studenta do DB
            if ($this->studentModel->create($firstName, $lastName, $birthDate, $class, $email, $phone, $imagePath)) {
                header("Location: ../controllers/student_list.php");
                exit();
            } else {
                echo "Chyba při ukládání studenta.";
            }
        }
    }

    public function listStudents() {
        $students = $this->studentModel->getAll();
        include '../views/students/student_list.php';
    }

    public function editStudent() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = intval($_POST['id']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $birthDate = htmlspecialchars($_POST['birth_date']);
            $class = htmlspecialchars($_POST['class']);
            $email = htmlspecialchars($_POST['email']);
            $phone = !empty($_POST['phone']) ? htmlspecialchars($_POST['phone']) : null;

            // Zpracování nahraných profilových obrázků (pokud jsou)
            $imagePath = null;
            if (!empty($_FILES['profile_image']['name'])) {
                $uploadDir = '../public/images/';
                $filename = basename($_FILES['profile_image']['name']);
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
                    $imagePath = '/public/images/' . $filename; // Relativní cesta
                }
            }

            // Aktualizace studenta v DB
            if ($this->studentModel->update($id, $firstName, $lastName, $birthDate, $class, $email, $phone, $imagePath)) {
                header("Location: ../controllers/student_list.php");
                exit();
            } else {
                echo "Chyba při aktualizaci studenta.";
            }
        }
    }

    public function deleteStudent($id) {
        if ($this->studentModel->delete($id)) {
            header("Location: ../controllers/student_list.php");
            exit();
        } else {
            echo "Chyba při mazání studenta.";
        }
    }
}

// Volání metod na základě akcí
$controller = new StudentController();

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'create':
            $controller->createStudent();
            break;
        case 'edit':
            $controller->editStudent();
            break;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $controller->deleteStudent($_GET['id']);
}

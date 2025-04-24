<?php
require_once '../models/Database.php';
require_once '../models/Book.php';

class BookController {
    private $db;
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->bookModel = new Book($this->db);
    }

    public function createBook() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Získání údajů z formuláře
            $title = htmlspecialchars($_POST['title']);
            $author = htmlspecialchars($_POST['author']);
            $category = htmlspecialchars($_POST['category']);
            $subcategory = !empty($_POST['subcategory']) ? htmlspecialchars($_POST['subcategory']) : null;
            $year = intval($_POST['year']);
            $price = floatval($_POST['price']);
            $isbn = htmlspecialchars($_POST['isbn']);
            $description = htmlspecialchars($_POST['description']);
            $link = htmlspecialchars($_POST['link']);

            // Získání ID přihlášeného uživatele
            session_start();
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;  // Předpokládám, že ID uživatele je ve session

            if (!$user_id) {
                // Pokud není uživatel přihlášen, vyhoďte chybu nebo přesměrujte
                echo "Musíte být přihlášený, abyste mohl přidat knihu.";
                exit();
            }

            // Zpracování nahraných obrázků
            $imagePaths = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/images/';
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $filename = basename($_FILES['images']['name'][$key]);
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $imagePaths[] = '/public/images/' . $filename; // Relativní cesta
                    }
                }
            }

            // Uložení knihy do DB s ID přihlášeného uživatele
            if ($this->bookModel->create($title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $imagePaths, $user_id)) {
                header("Location: ../controllers/book_list.php");
                exit();
            } else {
                echo "Chyba při ukládání knihy.";
            }
        }
    }

    public function listBooks () {
        $books = $this->bookModel->getAll();
        include '../views/books/book_list.php';
    }
}

// Volání metody při odeslání formuláře
$controller = new BookController();
$controller->createBook();

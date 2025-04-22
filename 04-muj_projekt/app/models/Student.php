<?php
class Student {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vytvoření nového studenta
    public function create($first_name, $last_name, $email, $dob, $course) {
        $sql = "INSERT INTO students (first_name, last_name, email, dob, course) 
                VALUES (:first_name, :last_name, :email, :dob, :course)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':dob' => $dob,
            ':course' => $course
        ]);
    }

    // Získání všech studentů
    public function getAll() {
        $sql = "SELECT * FROM students ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Získání studenta podle ID
    public function getById($id) {
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aktualizace informací o studentovi
    public function update($id, $first_name, $last_name, $email, $dob, $course) {
        $sql = "UPDATE students 
                SET first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    dob = :dob,
                    course = :course
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':dob' => $dob,
            ':course' => $course
        ]);
    }

    // Mazání studenta
    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>

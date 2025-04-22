<?php
class Student {
    private $conn;
    private $table = "students";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($firstName, $lastName, $birthDate, $class, $email, $phone, $imagePath) {
        $query = "INSERT INTO " . $this->table . " (first_name, last_name, birth_date, class, email, phone, profile_image) 
                  VALUES (:first_name, :last_name, :birth_date, :class, :email, :phone, :profile_image)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':profile_image', $imagePath);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $firstName, $lastName, $birthDate, $class, $email, $phone, $imagePath) {
        $query = "UPDATE " . $this->table . " 
                  SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, 
                      class = :class, email = :email, phone = :phone, profile_image = :profile_image
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':profile_image', $imagePath);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

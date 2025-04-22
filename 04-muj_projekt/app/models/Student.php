<?php
class Student {
    private $db;
    private $table_name = "students";

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($firstName, $lastName, $email, $dob, $course) {
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, dob, course) 
                  VALUES (:first_name, :last_name, :email, :dob, :course)";

        $stmt = $this->db->prepare($query);

        // Bind values
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":dob", $dob);
        $stmt->bindParam(":course", $course);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $firstName, $lastName, $email, $dob, $course) {
        $query = "UPDATE " . $this->table_name . " 
                  SET first_name = :first_name, last_name = :last_name, email = :email, 
                      dob = :dob, course = :course WHERE id = :id";

        $stmt = $this->db->prepare($query);

        // Bind values
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":dob", $dob);
        $stmt->bindParam(":course", $course);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>

<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'your_db_name';
    private $username = 'root';  // přizpůsob podle tvé konfigurace
    private $password = '';      // přizpůsob podle tvé konfigurace
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Chyba připojení: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

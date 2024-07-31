<?php
class User {
    private $conn;
    private $table_name = "users";
    
    public $id;
    public $name;
    public $email;
    public $password;
    public $dob;
    
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {

        $query = "INSERT INTO " . $this->table_name . " (name, email, password, dob) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssss", $this->name, $this->email, $this->password, $this->dob);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function getUsers() {
        
        $query = "SELECT * FROM " . $this->table_name;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $users = array();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
    
        return $users;
    }

    public function update() {

        $query = "UPDATE " . $this->table_name . " SET name = ?, email = ?, password = ?, dob = ? WHERE id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param("ssssi", $this->name, $this->email, $this->password, $this->dob, $this->id);
    
        if($stmt->execute()) {
            return true;
        }
    
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }
    

    public function delete() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param("i", $this->id);
    
        if($stmt->execute()) {
            return true;
        }
    
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }
    

}
?>


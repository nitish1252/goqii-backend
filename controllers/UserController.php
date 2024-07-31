<?php
require_once './models/user.php';

class UserController {
    public function createUser() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dob = $_POST['dob'];

            $user = new User();

            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->dob = $dob;

            if ($user->save()) {
                echo json_encode(array("message" => "User created successfully"));
            } else {
                echo json_encode(array("message" => "Unable to create user"));
            }
        }
        else {
            echo json_encode(array("message" => "405 Method Not Allowed"));
        }
    }

    public function getUserDetails() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            $user = new User();
            $userData = $user->getUsers();
    
            if ($userData) {
                echo json_encode($userData);
            } else {
                echo json_encode(array("message" => "User not found"));
            }
        } else {
            echo json_encode(array("message" => "405 Method Not Allowed"));
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dob = $_POST['dob'];
    
            if (!isset($id)) {
                echo json_encode(array("message" => "User ID is required"));
                return;
            }
    
            $user = new User();
    
            $user->id = $id;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->dob = $dob;
    
            if ($user->update()) {
                echo json_encode(array("message" => "User updated successfully"));
            } else {
                echo json_encode(array("message" => "Unable to update user"));
            }
        } else {
            echo json_encode(array("message" => "405 Method Not Allowed"));
        }
    }

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
    
            if (!isset($id)) {
                echo json_encode(array("message" => "User ID is required"));
                return;
            }
    
            $user = new User();
            $user->id = $id;
    
            if ($user->delete()) {
                echo json_encode(array("message" => "User deleted successfully"));
            } else {
                echo json_encode(array("message" => "Unable to delete user"));
            }
        } else {
            echo json_encode(array("message" => "405 Method Not Allowed"));
        }
    }
    

}
?>




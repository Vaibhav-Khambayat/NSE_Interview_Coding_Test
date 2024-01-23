<?php
require_once('../Model/UserModel.php');

class RegisterController {
    private $uploadDir = '../Documents/';
    public function __construct() {
        $this->userModel = new UserModel();
    }

   
    public function register() {

        $Data = new stdClass();

        $UserName = isset($_POST['UserName']) ? $_POST['UserName'] : null;
        $UserMobile = isset($_POST['UserMobile']) ? $_POST['UserMobile'] : null;
        $UserEmail = isset($_POST['UserEmail']) ? $_POST['UserEmail'] : null;
        $UserPassword = isset($_POST['UserPassword']) ? $_POST['UserPassword'] : null;
        $PasswordValidation = $this->validatePassword($UserPassword);
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $UserName)){
            $Data->Message = "Invalid User Name. Must be alphanumeric with underscores only.";
        }else if (!preg_match('/^[6-9]\d{9}$/', $UserMobile)) {
            $Data->Message = "Invalid Mobile Number. Must be a 10-digit starting with 6, 7, 8, or 9.";
        }else if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)){
            $Data->Message = "Invalid UserEmail format.";
        }else if($PasswordValidation !== true){
            $Data->Message = $PasswordValidation;
        }else if (empty($_FILES['File']['name'])) {
            $Data->Message = "No File Uploaded";
        }else{
            $file = $_FILES['File'];
            $targetFile = $this->uploadDir . basename($file['name']);
            if(move_uploaded_file($file['tmp_name'], $targetFile)){
                $Data->Message = "File Uploaded Successfully";
            }else{
                $Data->Message = "File Upload Failed";
            }
            $result = $this->userModel->registerUser($UserName, $UserMobile, $UserEmail, password_hash($UserPassword,PASSWORD_DEFAULT),basename($file['name']));

            if ($result !== false) {
                $Data->Success = true;
                $Data->UserId = $result;
                $Data->Message = "Registration successful.";
            } else {
                $Data->Success = false;
                $Data->ErrorMessage = "Registration failed.";
            }
        }
    
        $this->print_api_response_data($Data);
    }

    public function validatePassword($UserPassword) {
        if (strlen($UserPassword) < 8) {
            return "Password must be at least 8 characters long.";
        }else if (!preg_match('/[A-Z]/', $UserPassword)) {
            return "Password must contain at least one capital letter.";
        }else if (!preg_match('/[0-9]/', $UserPassword)) {
            return "Password must contain at least one number.";
        }else if (!preg_match('/[^A-Za-z0-9]/', $UserPassword)) {
            return "Password must contain at least one special character.";
        }else{
            return true;
        }
    }

    private function print_api_response_data($Data) {
        header('Content-Type: application/json');
        echo json_encode($Data);
        return;
    }
}

$RegisterController = new RegisterController();
$RegisterController->register();

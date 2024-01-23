<?php

require_once('../Model/UserModel.php');

class LoginController {
    public function __construct() {
        $this->userModel = new UserModel();
    }


    public function login() {
        $UserName = isset($_POST['UserName']) ? $_POST['UserName'] : null;
        $UserMobile = isset($_POST['UserMobile']) ? $_POST['UserMobile'] : null;
        $UserEmail = isset($_POST['UserEmail']) ? $_POST['UserEmail'] : null;
        $UserPassword = isset($_POST['UserPassword']) ? $_POST['UserPassword']: null;

        $Data = new stdClass();

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $UserName)){
            $Data->Message = "Invalid User Name. Must be alphanumeric with underscores only.";
        }else if (!preg_match('/^[6-9]\d{9}$/', $UserMobile)) {
            $Data->Message = "Invalid Mobile Number. Must be a 10-digit starting with 6, 7, 8, or 9.";
        }else if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)){
            $Data->Message = "Invalid UserEmail format.";
        }else{
            $result = $this->userModel->loginUser($UserName, $UserMobile, $UserEmail);
            if ($result !== false) {
                if(password_verify($UserPassword,$result[0]['UserPassword'])){
                    $Data->Success = true;
                    $Data->UserInfo = $result;
                    $Data->Message = "Login successful.";
                }else{
                    $Data->Success = false;
                    $Data->ErrorMessage = "Login failed";
                }
            
            } else {
                $Data->Success = false;
                $Data->ErrorMessage = "Login failed";
            }
        }
        $this->print_api_response_data($Data);
    }


    private function print_api_response_data($Data) {
        header('Content-Type: application/json');
        echo json_encode($Data);
        return;
    }
}

$LoginController = new LoginController();
$LoginController->login();

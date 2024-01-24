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

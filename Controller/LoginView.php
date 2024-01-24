<?php
class LoginView {
    public function __construct() {
        $this->userModel = new UserModel();
    }
    public function View(){
        $data = array(
            "title" => "Products",
        );
        $viewPath = __DIR__ . '/../View/login.php';
        include($viewPath);

	}
}
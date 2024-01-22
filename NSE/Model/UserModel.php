<?php

class UserModel {
    private $db;

    public function __construct() {
        $Host = "localhost";
        $Username = "root";
        $Password = "";
        $Name = "nse_test";

        $this->db = new mysqli($Host, $Username, $Password, $Name);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function registerUser($UserName, $UserMobile, $UserEmail, $UserPassword, $UserFileName) {
        $query = $this->db->prepare("CALL usp_insert_userinfo(?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $UserName, $UserMobile, $UserEmail, $UserPassword, $UserFileName);
        $query->execute();
        if ($query->errno) {
            die("Execution failed: " . $query->error);
        }
        $result = $query->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);

        $query->free_result();
        if (!empty($data)) {
            return $data[0]['UserId'];
        } else {
            return false;
        }

    }

    public function loginUser($UserName, $UserMobile, $UserEmail) {
        $query = $this->db->prepare("CALL usp_get_login_info(?, ?, ?)");
        $query->bind_param("sss", $UserName, $UserMobile, $UserEmail);
        $query->execute();

        $result = $query->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);

        $query->free_result();
        if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }
}


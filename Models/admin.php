<?php 
    class Admin{
        public $id;
        public $username;
        public $pwd_hash;
        public $full_name;
        public $email;
        public $phone;
        public $create_at;
        public $update_at;
        public $pwd_reset_token;
        public $id_position;
        public $ID_employee_number;
        public $salt_passwd;
        
        public function __construct($_id, $_username, $_pwd_hash, $_full_name, $_email, $_phone, $_create_at, $_update_at, $_pwd_reset_token, $_id_position, $_ID_employee_number, $_salt_passwd){
            $this->id = $_id;
            $this->username = $_username;
            $this->pwd_hash = $_pwd_hash;
            $this->full_name = $_full_name;
            $this->email = $_email;
            $this->phone  = $_phone;
            $this->ID_employee_number = $_ID_employee_number;
            $this->create_at = $_create_at;
            $this->update_at = $_update_at;
            $this->pwd_reset_token = $_pwd_reset_token;
            $this->id_position= $_id_position;
            $this->salt_passwd = $_salt_passwd;
        }
    }
?>
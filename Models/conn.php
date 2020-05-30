<?php 
class Conn{
    public $servername= "127.0.0.1:3306";
    public $database= "dienthoaididong";
    public $username= ""; // username
    public $password= ""; // password

    public function __construct(){}

    public function connect(){
        return $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
    }

    public function create($_server, $_username, $_password, $_database){
        $conn = new mysqli($_server, $_username, $_password, $_database);
    }
}
    
?>
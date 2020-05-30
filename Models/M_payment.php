<?php 
    require_once("payment_method.php");
    require_once("conn.php");
    class Model_payment_method{
        public function __construct(){}

        public function getAllMethod(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM payment_method WHERE status='1'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $method= new Payment_method($row['id'], $row['name'], $row['create_at'], $row['update_at']);
                $out[]=$method;
            }
            $conn->close();
            return $out;
        }

        public function getMethodID($idMethod){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM payment_method WHERE id='$idMethod'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $method= new Payment_method($row['id'], $row['name'], $row['create_at'], $row['update_at']);
            $conn->close();
            return $method;
        }

    }

?>
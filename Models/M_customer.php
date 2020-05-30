<?php 
    require_once("customer.php");
    require_once("conn.php");
    require_once('check.php');
    class Model_customer{
        public function __construct(){}

        public function getCustomer($username, $password){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM customer WHERE username='$username'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $tmp2=$result->fetch_assoc();
                $password_crypt = md5($password.$tmp2['salt_passwd']);
                if($password_crypt == $tmp2['pwd_hash']){
                    $out = new Customer($tmp2['id'], $tmp2['username'], $tmp2['pwd_hash'], $tmp2['full_name'], $tmp2['email'], $tmp2['phone'], $tmp2['address'], $tmp2['create_at'], $tmp2['update_at'], $tmp2['pwd_reset_token'], $tmp2['bank_number'], $tmp2['salt_passwd']);
                    $conn->close();
                    return $out;
                }
            }
            $conn->close();
            return null;
        }

        public function editCustomer($id, $name, $email, $address, $phone, $bank){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at=(String)date('d-m-Y H:i:s');
            $sql="UPDATE customer SET full_name='$name', email='$email', phone='$phone', address='$address', bank_number='$bank', update_at='$update_at' WHERE id='$id'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }

        public function resetPassword($username){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM customer WHERE username='$username'";
            $result=$conn->query($sql);
            if($result->num_rows > 0){
                $tmp2=$result->fetch_assoc();
                $newpass= md5($tmp2['pwd_reset_token'].$tmp2['salt_passwd']);
                $new_pwd_reset= bin2hex(random_bytes(10));
                $update_at = (String)date('d-m-Y H:i:s');
                $sql="UPDATE customer SET pwd_hash='$newpass', pwd_reset_token='$new_pwd_reset', update_at='$update_at' WHERE username='$username'";
                $result=$conn->query($sql);
                $out = new Customer($tmp2['id'], $tmp2['username'], $tmp2['pwd_hash'], $tmp2['full_name'], $tmp2['email'], $tmp2['phone'], $tmp2['address'], $tmp2['create_at'], $tmp2['update_at'], $tmp2['pwd_reset_token'], $tmp2['bank_number'], $tmp2['salt_passwd']);
                $conn->close();
                return $out;
            }
            $conn->close();
            return null;
        }

        public function createCustomer($username, $password, $fullname, $phone, $email, $address){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM customer WHERE username='$username'";
            $result=$conn->query($sql);
            if($result->num_rows > 0){
                $conn->close();
                return null;
            }
            else{
                $salt_passwd = bin2hex(random_bytes(10));
                $pwd_hash = md5($password.$salt_passwd);
                $pwd_reset_token = bin2hex(random_bytes(10));
                $create_at = (String)date('d-m-Y H:i:s');
                $update_at = $create_at;
                $sql="INSERT INTO customer(username, pwd_hash, full_name, email, phone, address, create_at, update_at, pwd_reset_token, salt_passwd) VALUES('$username', '$pwd_hash', '$fullname', '$email', '$phone', '$address', '$create_at', '$update_at', '$pwd_reset_token', '$salt_passwd')";
                $result=$conn->query($sql);
                $conn->close();
                return true;
            }
        }

        public function changePasswd($id, $passwd, $new_passwd){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM customer WHERE id='$id'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $tmp2=$result->fetch_assoc();
                $password_crypt = md5($passwd.$tmp2['salt_passwd']);
                if($password_crypt == $tmp2['pwd_hash']){
                    $new_passwd_hash = md5($new_passwd.$tmp2['salt_passwd']);
                    $update_at = (String)date('d-m-Y H:i:s');
                    $sql="UPDATE customer SET pwd_hash='$new_passwd_hash', update_at='$update_at' WHERE id='$id'";
                    $result=$conn->query($sql);
                    $conn->close();
                    return 3;
                }
                else{
                    $conn->close();
                    return 2;
                } 
            }
            $conn->close();
            return 1;
        }

        public function getCustomerID($id){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM customer WHERE id='$id'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $tmp2=$result->fetch_assoc();
                $out = new Customer($tmp2['id'], $tmp2['username'], $tmp2['pwd_hash'], $tmp2['full_name'], $tmp2['email'], $tmp2['phone'], $tmp2['address'], $tmp2['create_at'], $tmp2['update_at'], $tmp2['pwd_reset_token'], $tmp2['bank_number'], $tmp2['salt_passwd']);
                $conn->close();
                return $out;
            }
            $conn->close();
            return null;
        }

    }


?>
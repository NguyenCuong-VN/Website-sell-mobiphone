<?php 
    require_once("admin.php");
    require_once("conn.php");
    class Model_admin{
        public function __construct(){}

        public function getAdmin($username, $password){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE username='$username'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $tmp2=$result->fetch_assoc();
                $password_crypt = md5($password.$tmp2['salt_passwd']);
                if($password_crypt == $tmp2['pwd_hash']){
                    $out = new Admin($tmp2['id'], $tmp2['username'], $tmp2['pwd_hash'], $tmp2['full_name'], $tmp2['email'], $tmp2['phone'], $tmp2['create_at'], $tmp2['update_at'], $tmp2['pwd_reset_token'], $tmp2['id_position'], $tmp2['ID_employee_number'], $tmp2['salt_passwd']);
                    $conn->close();
                    return $out;
                }
            }
            $conn->close();
            return null;
        }

        public function getAllAdminIDAndPosition($id){
            require_once("M_position.php");
            require_once("position.php");
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE id='$id'";
            $result=$conn->query($sql);
            $row = $result->fetch_assoc();
            $admin= new Admin($row['id'], $row['username'], $row['pwd_hash'], $row['full_name'], $row['email'], $row['phone'], $row['create_at'], $row['update_at'], $row['pwd_reset_token'], $row['id_position'], $row['ID_employee_number'], $row['salt_passwd']);
            $model_position= new Model_position();
            $position= $model_position->getPositionID($admin->id_position);
            $admin->id_position = $position->name;
            $conn->close();
            return $admin;
        }

        public function getAllAdminAndPosition(){
            require_once("M_position.php");
            require_once("position.php");
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $admin= new Admin($row['id'], $row['username'], $row['pwd_hash'], $row['full_name'], $row['email'], $row['phone'], $row['create_at'], $row['update_at'], $row['pwd_reset_token'], $row['id_position'], $row['ID_employee_number'], $row['salt_passwd']);
                $model_position= new Model_position();
                $position= $model_position->getPositionID($admin->id_position);
                $admin->id_position = $position->name;
                $out[]=$admin;
            }
            $conn->close();
            return $out;
        }

        public function searchAllAdminAndPosition($name){
            require_once("M_position.php");
            require_once("position.php");
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE full_name like '%$name%'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $admin= new Admin($row['id'], $row['username'], $row['pwd_hash'], $row['full_name'], $row['email'], $row['phone'], $row['create_at'], $row['update_at'], $row['pwd_reset_token'], $row['id_position'], $row['ID_employee_number'], $row['salt_passwd']);
                $model_position= new Model_position();
                $position= $model_position->getPositionID($admin->id_position);
                $admin->id_position = $position->name;
                $out[]=$admin;
            }
            $conn->close();
            return $out;
        }

        public function resetPassword($username){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE username='$username'";
            $result=$conn->query($sql);
            if($result->num_rows > 0){
                $tmp2=$result->fetch_assoc();
                $newpass= md5($tmp2['pwd_reset_token'].$tmp2['salt_passwd']);
                $new_pwd_reset= bin2hex(random_bytes(10));
                $update_at = (String)date('d-m-Y H:i:s');
                $sql="UPDATE nhan_vien SET pwd_hash='$newpass', pwd_reset_token='$new_pwd_reset', update_at='$update_at' WHERE username='$username'";
                $result=$conn->query($sql);
                $out = new Admin($tmp2['id'], $tmp2['username'], $tmp2['pwd_hash'], $tmp2['full_name'], $tmp2['email'], $tmp2['phone'], $tmp2['create_at'], $tmp2['update_at'], $tmp2['pwd_reset_token'], $tmp2['id_position'], $tmp2['ID_employee_number'], $tmp2['salt_passwd']);
                $conn->close();
                return $out;
            }
            $conn->close();
            return null;
        }

        public function createAdmin($username, $password, $fullname, $phone, $email, $id_position, $ID_employee_number){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE username='$username'";
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
                $sql="INSERT INTO nhan_vien(username, pwd_hash, full_name, email, phone, create_at, update_at, pwd_reset_token, salt_passwd, id_position, ID_employee_number) VALUES('$username', '$pwd_hash', '$fullname', '$email', '$phone', '$create_at', '$update_at', '$pwd_reset_token', '$salt_passwd', '$id_position', '$ID_employee_number')";
                $result=$conn->query($sql);
                $conn->close();
                return true;
            }
            $conn->close();
            return;
        }

        public function editAdmin($id, $name, $email, $phone){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at=(String)date('d-m-Y H:i:s');
            $sql="UPDATE nhan_vien SET full_name='$name', email='$email', phone='$phone', update_at='$update_at' WHERE id='$id'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }

        public function changePasswd($id, $passwd, $new_passwd){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM nhan_vien WHERE id='$id'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $tmp2=$result->fetch_assoc();
                $password_crypt = md5($passwd.$tmp2['salt_passwd']);
                if($password_crypt == $tmp2['pwd_hash']){
                    $new_passwd_hash = md5($new_passwd.$tmp2['salt_passwd']);
                    $update_at = (String)date('d-m-Y H:i:s');
                    $sql="UPDATE nhan_vien SET pwd_hash='$new_passwd_hash', update_at='$update_at' WHERE id='$id'";
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

        public function editPosition($id, $id_position){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at=(String)date('d-m-Y H:i:s');
            $sql="UPDATE nhan_vien SET id_position='$id_position', update_at='$update_at' WHERE id='$id'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }
    }

?>
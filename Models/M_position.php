<?php 
    require_once("position.php");
    require_once("conn.php");
    require_once("check.php");
    class Model_position{
        public function __construct(){}

        public function getAllPosition(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.position WHERE status='1'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $position= new Position($row['id'], $row['name'], $row['description'], $row['status']);
                $out[]=$position;
            }
            $conn->close();
            return $out;
        }

        public function getAllPermission(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.permission WHERE status='1'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $out[$row['id']]=$row['name'];
            }
            $conn->close();
            return $out;
        }

        public function getPositionID($id){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.position WHERE id='$id'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $position= new Position($row['id'], $row['name'], $row['description'], $row['status']);
            $conn->close();
            return $position;
        }

        public function checkPositionPermission($idPosition, $idPermission){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.permission_of_position WHERE id_position='$idPosition' and id_permission='$idPermission'";
            $result=$conn->query($sql);
            if($result->num_rows > 0 ){
                $conn->close();
                return true;
            }
            $conn->close();
            return false;
        }

        public function getPositionPermission($idPosition){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT permission.id, permission.name FROM permission, permission_of_position WHERE permission_of_position.id_position='$idPosition' and permission_of_position.id_permission=permission.id";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $out[$row['id']] = $row['name'];
            }
            $conn->close();
            return $out;
        }

        public function setPermissionPosition($machucdanh, $tenchucdanh, $mota, $quyenhan){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql = "UPDATE dienthoaididong.position SET name='$tenchucdanh', description='$mota' WHERE id='$machucdanh'";
            $result=$conn->query($sql);
            $sql = "DELETE FROM dienthoaididong.permission_of_position WHERE id_position='$machucdanh'";
            $result=$conn->query($sql);
            foreach($quyenhan as $row){
                $sql = "INSERT INTO dienthoaididong.permission_of_position (id_position, id_permission) VALUES ('$machucdanh', '$row')";
                $result=$conn->query($sql);
            }
            $conn->close();
            return true;
        }

        public function searchPosition($search){
            if(checkString($search)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM position where name like '%$search%'";
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $position= new Position($row['id'], $row['name'], $row['description'], $row['status']);
                    $out[]=$position;
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function createPosition($tenchucdanh ,$motachucdanh, $quyenhan){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql = "INSERT INTO dienthoaididong.position (name, description, status) VALUES ('$tenchucdanh' ,'$motachucdanh', '1')";
            $result=$conn->query($sql);
            $sql = "SELECT * FROM dienthoaididong.position WHERE name='$tenchucdanh'";
            $result=$conn->query($sql);
            $position = $result->fetch_assoc();
            $id = $position['id'];
            foreach($quyenhan as $row){
                $sql = "INSERT INTO dienthoaididong.permission_of_position (id_position, id_permission) VALUES ('$id', '$row')";
                $result=$conn->query($sql);
            }
            $conn->close();
            return true;
        }
    }

?>
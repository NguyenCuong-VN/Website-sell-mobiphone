<?php 
    require_once("category.php");
    require_once("conn.php");
    require_once("check.php");
    class Model_category{
        public function __construct(){}

        public function getAllCategory(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.category";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $category= new Category($row['id'], $row['name'], $row['description'], $row['create_at'], $row['update_at']);
                $out[]=$category;
            }
            $conn->close();
            return $out;
        }

        public function getCategoryID($idCategory){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.category WHERE id='$idCategory'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $category= new Category($row['id'], $row['name'], $row['description'], $row['create_at'], $row['update_at']);
            $conn->close();
            return $category;
        }

        public function editCategory($id, $ten, $noidung){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at=(String)date('d-m-Y H:i:s');
            $sql="UPDATE dienthoaididong.category SET name='$ten', description='$noidung', update_at='$update_at' WHERE id='$id'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }

        public function searchCategory($search){
            if(checkString($search)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM category where name like '%$search%'";
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $category= new Category($row['id'], $row['name'], $row['description'], $row['create_at'], $row['update_at']);
                    $out[]=$category;
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function createCategory($name ,$content){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $create_at = (String)date('d-m-Y H:i:s');
            $update_at = $create_at;
            $sql = "INSERT INTO dienthoaididong.category (name, description, update_at, create_at) VALUES ('$name' ,'$content', '$update_at', '$create_at')";
            $result=$conn->query($sql);
                $conn->close();
                return true;
        }
    }
?>

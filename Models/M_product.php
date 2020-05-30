<?php 
    require_once("product.php");
    require_once("conn.php");
    require_once("check.php");
    class Model_product{
        public function __construct(){}
        
        public function getAllProduct(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM product";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                $out[]=$product;
            }
            $conn->close();
            return $out;
        }

        public function getAllProductAndCategory(){
            require_once("M_category.php");
            require_once("category.php");
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM product";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                $model_cate= new Model_category();
                $cate= $model_cate->getCategoryID($product->category_id);
                $product->category_id=$cate->name;
                $out[]=$product;
            }
            $conn->close();
            return $out;
        }

        public function getProductID($id){
            if(checkNum($id)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM product where id='%s'";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $id));
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                    $out[]=$product;
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function getImageProduct($id){
            if(checkNum($id)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM image_product where id_product='%s'";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $id));
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    
                    $out[]=$row['image_link'];
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function getColorProduct($id){
            if(checkNum($id)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="select color.name from product_color, color where product_color.id_product='%s' and product_color.id_color=color.id;";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $id));
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    
                    $out[]=$row['name'];
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function getProductCategory($id_cate){
            if(checkNum($id_cate)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM product where category_id='%s'";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $id_cate));
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                    $out[]=$product;
                }
                $conn->close();
                return $out;
            }
            else return null;
            }

        public function searchProduct($search){
            if(checkString($search)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM product where name like '%s'";
                $search='%'.$search.'%';
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $search));
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                    $out[]=$product;
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function searchProductAndCategory($search, $id_cate){
            require_once("category.php");
            require_once("M_category.php");
            if(checkString($search)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                if(!$id_cate == ''){
                    $sql="SELECT * FROM product where name like '%$search%' and category_id='$id_cate'";
                }
                else{
                    $sql="SELECT * FROM product where name like '%$search%'";
                }
                $result=$conn->query($sql);
                $out;
                while($row = $result->fetch_assoc()){
                    $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                    $model_cate= new Model_category();
                    $cate= $model_cate->getCategoryID($product->category_id);
                    $product->category_id=$cate->name;
                    $out[]=$product;
                }
                $conn->close();
                return $out;
            }
            else return null; 
        }

        public function productInGio($idProduct, $idCustomer){
            if(checkNum($idProduct) && checkNum($idCustomer)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM gio_hang WHERE id_product='%s' and id_customer='%s'";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $idProduct), mysqli_real_escape_string($conn, $idCustomer));
                $result=$conn->query($sql);
                if($result->num_rows > 0){
                    $conn->close();
                    return true;
                    
                }
                else{
                    $conn->close();
                    return false;
                } 
            }
            else return null; 
        }

        public function intoGio($idProduct, $idCustomer){
            if($this->productInGio($idProduct, $idCustomer)) return 1;
            elseif(checkNum($idProduct) && checkNum($idCustomer)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $create_at = (String)date('d-m-Y H:i:s');
                $sql="INSERT INTO gio_hang(id_customer, id_product, create_at) VALUES('$idCustomer', '$idProduct', '$create_at')";
                $result=$conn->query($sql);
                $conn->close();
                return 2;
            }
            else return 3; 
        }

        public function deleteProductInGio($idProduct, $idCustomer){
            if($this->productInGio($idProduct, $idCustomer)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="DELETE FROM gio_hang WHERE id_customer='$idCustomer' and id_product='$idProduct'";
                $result=$conn->query($sql);
                $conn->close();
                return 1;
            }
            else return null; 
        }

        public function getGio($idCustomer){
            if(checkNum($idCustomer)){
                $tmp= new Conn();
                $conn=$tmp->connect();
                $sql="SELECT * FROM gio_hang WHERE id_customer='%s'";
                $sql= sprintf($sql, mysqli_real_escape_string($conn, $idCustomer));
                $result=$conn->query($sql);
                if($result->num_rows > 0){
                    $sql="SELECT * FROM product WHERE id in (";
                    while($row = $result->fetch_assoc()){
                        $sql=$sql.$row['id_product'].',';
                    }
                    $sql=substr($sql, 0, strlen($sql)-1);
                    $sql=$sql.")";
                    $result=$conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        $product= new Product($row['id'], $row['name'], $row['image_thumbnail'], $row['content'], $row['price'], $row['percent_sale'], $row['sale_price'], $row['category_id'], $row['amount'], $row['create_at'], $row['update_at']);
                        $out[]=$product;
                    }
                    $conn->close();
                    return $out;
                }
                else{
                    $conn->close();
                    return null;
                } 
            }
            else return null; 
        }

        public function editProduct($id, $tensp, $noidungsp, $giasp, $giamsp, $giagiamsp, $soluongsp){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at=(String)date('d-m-Y H:i:s');
            $sql="UPDATE dienthoaididong.product SET name='$tensp', content='$noidungsp', price='$giasp', update_at='$update_at', percent_sale='$giamsp', sale_price='$giagiamsp', amount='$soluongsp' WHERE id='$id'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }

        public function createProduct($name ,$image_thumbnail, $content, $price, $percent_sale, $sale_price, $category_id, $amount){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $create_at = (String)date('d-m-Y H:i:s');
            $update_at = $create_at;
            $sql = "INSERT INTO dienthoaididong.product (name, image_thumbnail, content, price, percent_sale, sale_price, category_id, amount, update_at, create_at) VALUES ('$name' ,'$image_thumbnail', '$content', '$price', '$percent_sale', '$sale_price', '$category_id', '$amount', '$update_at', '$create_at')";
            $result=$conn->query($sql);
            $product=$this->searchProductAndCategory($name, $category_id);
            $product = $product[0];
            $conn->close();
            return $product;
        }

        public function setImageProduct($name, $id_product, $image_link){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql = "INSERT INTO dienthoaididong.image_product (name, id_product, image_link) VALUES ('$name', '$id_product', '$image_link')";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }
    }

?>
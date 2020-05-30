<?php 
    require_once("order.php");
    require_once("conn.php");
    require_once("M_deliver.php");
    require_once("M_payment.php");
    class Model_order{
        public function __construct(){}

        public function getStatus($id_status_order){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.status_order WHERE id='$id_status_order'";
            $result=$conn->query($sql);
            $out= $result->fetch_assoc();
            $conn->close();
            return $out;
        }

        public function getOrderID($idOrder){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.order WHERE id='$idOrder'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $order= new Order($row['id'], $row['id_customer'], $row['id_status_order'], $row['address_ship'], $row['phone_number'], $row['name_deliver_method'],  $row['name_payment_method'], $row['info_payment'], $row['create_at'], $row['update_at'], $row['total_price']);
            
            $status=$this->getStatus($order->id_status_order);
            $order->id_status_order=$status['status'];
            
            $conn->close();
            return $order;
        }

        public function getAllOrder(){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.order";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $order= new Order($row['id'], $row['id_customer'], $row['id_status_order'], $row['address_ship'], $row['phone_number'], $row['name_deliver_method'],  $row['name_payment_method'], $row['info_payment'], $row['create_at'], $row['update_at'], $row['total_price']);
                $status=$this->getStatus($order->id_status_order);
                $order->id_status_order=$status['status'];
                $out[]=$order;
            }
            $conn->close();
            return $out;
        }

        public function getAllOrderCustomer($idCus){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.order WHERE id_customer='$idCus'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $order= new Order($row['id'], $row['id_customer'], $row['id_status_order'], $row['address_ship'], $row['phone_number'], $row['name_deliver_method'],  $row['name_payment_method'], $row['info_payment'], $row['create_at'], $row['update_at'], $row['total_price']);
                $status=$this->getStatus($order->id_status_order);
                $order->id_status_order=$status['status'];
                $out[]=$order;
            }
            $conn->close();
            return $out;
        }

        public function getOrderTime($create_at){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql = "SELECT * FROM dienthoaididong.order WHERE create_at='$create_at'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $out= new Order($row['id'], $row['id_customer'], $row['id_status_order'], $row['address_ship'], $row['phone_number'], $row['name_deliver_method'],  $row['name_payment_method'], $row['info_payment'], $row['create_at'], $row['update_at'], $row['total_price']);
            $conn->close();
            return $out;
        }

        public function createOrder($items ,$id_customer, $address_ship, $phone_number, $name_deliver_method, $name_payment_method, $info_payment, $total_price){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $id_status_order=1;
            $create_at = (String)date('d-m-Y H:i:s');
            $update_at = $create_at;
            $sql = "INSERT INTO dienthoaididong.order (id_customer, create_at, id_status_order, address_ship, phone_number, name_deliver_method, name_payment_method, info_payment, update_at, total_price) VALUES ('$id_customer', '$create_at', '$id_status_order', '$address_ship', '$phone_number', '$name_deliver_method', '$name_payment_method', '$info_payment', '$update_at', '$total_price')";
            $result=$conn->query($sql);
            $order=$this->getOrderTime($create_at);
            $items = (array)$items;
            foreach($items as $key=>$value){
                $sql = "INSERT INTO products_in_order (id_product, id_order) VALUES ('$value' ,'$order->id')";
                $result=$conn->query($sql);
            }
            $conn->close();
            return true;
        }

        public function getProductOrder($idOrder)
        {   
            require_once("M_product.php");
            $tmp= new Conn();
            $conn=$tmp->connect();
            $sql="SELECT * FROM dienthoaididong.products_in_order WHERE id_order='$idOrder'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $model_product= new Model_product();
                $product = $model_product->getProductID($row['id_product']);
                $product = $product[0];
                $out[]=$product;
            }
            $conn->close();
            return $out;
        }

        public function updateStatus($id_status_order, $idOrder){
            $tmp= new Conn();
            $conn=$tmp->connect();
            $update_at = (String)date('d-m-Y H:i:s');
            $sql="UPDATE dienthoaididong.order SET id_status_order='$id_status_order', update_at='$update_at' WHERE id='$idOrder'";
            $result=$conn->query($sql);
            $conn->close();
            return true;
        }

        public function searchOrder($date, $month, $year, $status, $idOrder){
            $tmp= new Conn();
            $conn=$tmp->connect();
            if($date > 0 && $date <10) $date='0'.$date;
            if($month > 0 && $month <10) $month='0'.$month;
            $time = $date.'-'.$month.'-'.$year;
            $sql="SELECT * FROM dienthoaididong.order WHERE create_at like '$time%' and id_status_order like '%$status%' and id like '$idOrder%'";
            $result=$conn->query($sql);
            $out;
            while($row = $result->fetch_assoc()){
                $order= new Order($row['id'], $row['id_customer'], $row['id_status_order'], $row['address_ship'], $row['phone_number'], $row['name_deliver_method'],  $row['name_payment_method'], $row['info_payment'], $row['create_at'], $row['update_at'], $row['total_price']);
                $status=$this->getStatus($order->id_status_order);
                $order->id_status_order=$status['status'];
                $out[]=$order;
            }
            $conn->close();
            return $out;
        }
    }
    

?>

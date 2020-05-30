<?php 
    session_start(); 
    //control create site thanhtoan
    if(isset($_GET['thanhtoan'])){
        if(!empty($_SESSION['items'])){
            $_SESSION['total']=$_GET['total'];
        require_once("./Models/deliver_method.php");
        require_once("./Models/payment_method.php");
        require_once("./Models/M_deliver.php");
        require_once("./Models/M_payment.php");
        $model_payment = new Model_payment_method();
        $payment_methods = $model_payment->getAllMethod();
        $model_deliver = new Model_deliver_method();
        $deliver_methods = $model_deliver->getAllMethod();
        return require_once("./Views/thongtinthanhtoan.php");
        }
        else{
            echo "1";  
            return;
        }
        
    }
    // control create order
    elseif(isset($_POST['btn_xacnhan'])){
        require_once("./Models/check.php");
        $name= $_POST['order_name'];
        $address= $_POST['order_address'];
        $phone= $_POST['order_phone'];
        $deliver_method= $_POST['order_deliver'];
        $payment_method= $_POST['order_payment'];
        $name = strip_tags($name);
        $name = addslashes($name);
        $address = strip_tags($address);
        $address = addslashes($address);
        $phone = strip_tags($phone);
        $phone = addslashes($phone);
        $deliver_method = strip_tags($deliver_method);
        $deliver_method = addslashes($deliver_method);
        $payment_method = strip_tags($payment_method);
        $payment_method = addslashes($payment_method);
        $info_payment='';
        $total_price=$_SESSION['total'];
        if(isset($_POST['order_bank'])){
            if(!checkNum($_POST['order_bank']) || $_POST['order_bank'] == ''){
                echo "1"; 
                return;
            } 
            else $info_payment='Số thẻ: '.$_POST['order_bank'];
        }

        if($name == "" || $address == "" || $phone == ""){
            echo "2";   
            return;
        }
        elseif(!checkNum($phone) && $phone != ""){
            echo "3";
            return;
        }
        else{
            require_once("./Models/deliver_method.php");
            require_once("./Models/payment_method.php");
            require_once("./Models/M_deliver.php");
            require_once("./Models/M_payment.php");
            require_once("./Models/order.php");
            require_once("./Models/M_order.php");
            $model_order = new Model_order();
            $create = $model_order->createOrder($_SESSION['items'] ,$_SESSION['id_customer'], $address, $phone, $deliver_method, $payment_method, $info_payment, $total_price);
            if($create){
                echo "5";
                return;
            }
            else{
                echo "4";
                return;
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        require_once("./Views/header.html");
        require_once("./Models/M_product.php");
        //control delete product in order
        if(isset($_GET['delId'])){           
            foreach($_SESSION['items'] as $key=>$value){
                if($value == $_GET['delId']){
                    unset($_SESSION['items'][$key]);
                break;
                }
            }
        }
        //control render site thanh toan khi click mua hang tu san pham
        elseif(isset($_GET['id'])){
            if(!isset($_SESSION['id_customer'])){
                header('Location: login.php');
            }
            $model_product = new Model_product();
            $products = $model_product->getProductID($_GET['id']); 
            $_SESSION['items'] = (array)$_GET['id'];
            require_once("./Views/thanhtoan.php");
        }
        //control render site thanh toan khi click mua hang tu gio hang
        elseif(isset($_SESSION['giohang'])){
            $tmp = $_SESSION['giohang'];
            $products;
            $items;
            foreach($tmp as $row){
                $arr = (array) $row;
                $one_product = new Product($arr['id'], $arr['name'], $arr['image_thumbnail'], $arr['content'], $arr['price'], $arr['percent_sale'], $arr['sale_price'], $arr['category_id'], $arr['amount'], $arr['create_at'], $arr['update_at']);
                $products[]=$one_product;
                $items[]=$one_product->id;
            }
            $_SESSION['items']=$items;
            require_once("./Views/thanhtoan.php");
        }
    ?>
</body>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>
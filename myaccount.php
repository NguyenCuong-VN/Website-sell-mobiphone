<?php 
    session_start();
?>

<?php 
    //check login
    if(!isset($_SESSION['id_customer'])){
        header('Location: login.php');
    }
    //control change password
    elseif(isset($_POST['savepasswd'])){
        require_once("./Models/check.php");
        require_once("./Models/M_customer.php");
        $old_passwd = $_POST['old_passwd'];
        $old_passwd = strip_tags($old_passwd);
        $old_passwd = addslashes($old_passwd);

        $new_passwd = $_POST['new_passwd'];
        $new_passwd = strip_tags($new_passwd);
        $new_passwd = addslashes($new_passwd);

        $renew_passwd = $_POST['renew_passwd'];
        $renew_passwd = strip_tags($renew_passwd);
        $renew_passwd = addslashes($renew_passwd);

        if($new_passwd == '' || $renew_passwd == '' || $old_passwd == ''){
            echo "1";
            return;
        }
        elseif($new_passwd != $renew_passwd){
            echo "2";
            return;
        }
        else{
            $model_customer = new Model_customer();
            $edit = $model_customer->changePasswd($_SESSION['id_customer'], $old_passwd, $new_passwd);
            if($edit== 1){
                echo "3";
                return;
            }
            elseif($edit== 2){
                echo "4";
                return;
            }
            else{
                echo "5";
                return;
            }
        }
    }
    //control change infomation customer
    elseif(isset($_POST['save'])){
        require_once("./Models/check.php");
        require_once("./Models/M_customer.php");
        $name_cus = $_POST['name_cus'];
        $email_cus = $_POST['email_cus'];
        $address_cus = $_POST['address_cus'];
        $phone_cus = $_POST['phone_cus'];
        $bank_cus = $_POST['bank_cus'];


        $name_cus = strip_tags($name_cus);
        $name_cus = addslashes($name_cus);
        $email_cus = strip_tags($email_cus);
        $email_cus = addslashes($email_cus);
        $address_cus = strip_tags($address_cus);
        $address_cus = addslashes($address_cus);
        $phone_cus = strip_tags($phone_cus);
        $phone_cus = addslashes($phone_cus);
        $bank_cus = strip_tags($bank_cus);
        $bank_cus = addslashes($bank_cus);

        if($name_cus == "" || $email_cus == ""){
            echo "1";
            return;
        }
        elseif(!checkNum($phone_cus) && $phone_cus != ''){
            echo "2";
            return;
        }
        elseif(!checkNum($bank_cus) && $bank_cus != ''){
            echo "3";
            return;
        }
        elseif(!checkEmail($email_cus)){
            echo "4";
            return;
        }
        else{
            $model_customer = new Model_customer();
            $edit = $model_customer->editCustomer($_SESSION['id_customer'], $name_cus, $email_cus, $address_cus, $phone_cus, $bank_cus);
            if($edit== null) echo "5";
            else{
                $_SESSION['name_customer'] = $name_cus;
                $_SESSION['email_customer'] = $email_cus;
                $_SESSION['address_customer'] = $address_cus;
                $_SESSION['phone_customer'] = $phone_cus;
                $_SESSION['bank_customer'] = $bank_cus;
                echo "6";
            }
            return;
        }
    }
    //control render content
    elseif(isset($_GET['content'])){
        if($_GET['content'] == "giohang"){
            require_once("./Models/M_product.php");
            $model_product= new Model_product();
            $products = $model_product->getGio($_SESSION['id_customer']);
            $_SESSION['giohang']=$products;
            return require_once("./Views/myaccount/giohang.php");
        }
        elseif($_GET['content'] == "info"){
            return require_once("./Views/myaccount/index.php");
        }
        elseif($_GET['content'] == "donhang"){
            require_once("./Models/M_order.php");
            $model_order = new Model_order();
            $order = $model_order->getAllOrderCustomer($_SESSION['id_customer']);
            return require_once("./Views/myaccount/donHang.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- render header -->
    <?php 
        require_once("./Views/header.html");
    ?>
    <br><br>
    <!-- render button content -->
    <center>
    <button type="button" class="btn btn-info" id="info" onclick="load(this.id)">Thông tin</button>
    <button type="button" class="btn btn-success" id="giohang" onclick="load(this.id)">Giỏ hàng</button>
    <button type="button" class="btn btn-danger" id="donhang" onclick="load(this.id)">Đơn hàng</button>
    </center>
    <div id="content"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
    


</body>
<br><br><br>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>
<!-- ajax render content -->
<script>
    function load(conte){
        $.ajax({
            url: 'http://localhost/dienthoaididong/myaccount.php',
            type: 'GET',
            dataType: 'html',
            data:{
                content: conte
            }
        }).done(function(ketqua){
            $('#content').html(ketqua);
        });
    }
</script>
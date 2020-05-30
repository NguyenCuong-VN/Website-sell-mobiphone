<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        require_once("./Models/check.php");
        require_once("./Views/header.html");
        require_once("./Models/customer.php");
        require_once("./Models/M_customer.php");
        //control create account 
        if(isset($_POST['btn_signup'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $repassword = $_POST['repassword'];
            $username = strip_tags($username);
            $username = addslashes($username);
            $password = strip_tags($password);
            $password = addslashes($password);
            $fullname = strip_tags($fullname);
            $fullname = addslashes($fullname);
            $email = strip_tags($email);
            $email = addslashes($email);
            $address = strip_tags($address);
            $address = addslashes($address);
            $repassword = strip_tags($repassword);
            $repassword = addslashes($repassword);
            $phone = strip_tags($phone);
            $phone = addslashes($phone);
            if($fullname == "" || $email == "" || $username == "" || $password == "" || $repassword == ""){
                echo "<p><center style=\"color: red\">Thấy mấy dấu * đỏ đỏ không, điền hết vào nha <3</center></p><br>";
            }
            elseif(!checkNum($phone) && $phone != ""){
                echo "<p><center style=\"color: red\">Số điện thoại thì chỉ có số thôi chứ?? Kiểm tra xem</center></p><br>";
            }
            elseif($password != $repassword){
                echo "<p><center style=\"color: red\">Gõ chậm lại nào, hai cái password không trùng nhau kìa bạn @@ </center></p><br>";
            }
            else{
                $model_customer = new Model_customer();
                $create = $model_customer->createCustomer($username, $password, $fullname, $phone, $email, $address);
                if($create == null) echo "<p><center style=\"color: red\">Tên nào lấy mất username này rồi, thử cái khác thôi :((</center></p><br>";
                else{
                    $_SESSION['username']=$username;
                    header('Location:index.php');
                }
            }
        }
        //render site signup
        require_once("./Views/signup.php");
    ?>
</body>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>
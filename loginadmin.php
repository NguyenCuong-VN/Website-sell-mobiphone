<?php 
    session_start();
    //mail folder
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        require_once("./Views/header.html");
        require_once("./Models/M_admin.php");
        echo "<br><br><br><br>";
        //control check account info login
        if(isset($_POST['btn_submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $username = strip_tags($username);
            $username = addslashes($username);
            $password = strip_tags($password);
            $password = addslashes($password);
            if($username == "" || $password == ""){
                echo "<p><center style=\"color: red\">Còn thiếu thông tin kìa, lại nào :v </center></p><br>";
            }
            else{
                $model_admin = new Model_admin();
                $admin = $model_admin->getAdmin($username, $password);
                if($admin == null) echo "<p><center style=\"color: red\">Hmm... Sai tên đăng nhập hoặc mật khẩu rồi. Bạn chắc mình nhập đúng chứ ???</center><p><br>";
                else {
                    $_SESSION['id_admin'] = $admin->id;
                    $_SESSION['name_admin'] = $admin->full_name;
                    $_SESSION['email_admin'] = $admin->email;
                    $_SESSION['phone_admin'] = $admin->phone;
                    $_SESSION['id_position_admin'] = $admin->id_position;
                    $_SESSION['ID_employee_number_admin'] = $admin->ID_employee_number;
                    $_SESSION['create_at_admin'] = $admin->create_at;
                    header('Location: manageradmin.php');
                }
            }
        }
        //control forgot password admin
        elseif (isset($_POST['btn_forgot'])) {
            $username = $_POST['username_forgot'];
            $username = strip_tags($username);
            $username = addslashes($username);
            if($username == ""){
                echo "<p><center style=\"color: red\">Phải cho mình biết username của bạn thì mới lấy lại được mật khẩu chứ ?? Kỳ ghê !?! </center></p><br>";
            }
            else{
                $model_admin = new Model_admin();
                $admin = $model_admin->resetPassword($username);
                if($admin == null) echo "<p><center style=\"color: red\">Sai tên đăng nhập rồi, quên nốt cái này là mất tiêu tài khoản luôn :3 </center><p><br>";
                else {
                    require_once("PHPMailer-master/src/Exception.php");
                    require_once("PHPMailer-master/src/OAuth.php");
                    require_once("PHPMailer-master/src/POP3.php");
                    require_once("PHPMailer-master/src/SMTP.php");
                    require_once("PHPMailer-master/src/PHPMailer.php");

                    //send email to email address of user
                    $mail = new PHPMailer(true);
                    try{
                        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'dienthoaididong226@gmail.com';                 // SMTP username
                        $mail->Password = 'dpmqbolyqpeoucjy';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
                    
                        //Recipients
                        $mail->setFrom('dienthoaididong226@gmail.com', 'Dien thoai di dong');
                        $mail->addAddress("$admin->email");     // Add a recipient
                    
                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Reset password';
                        $mail->Body    = "Mật khẩu của bạn đã được reset thành: <b>$admin->pwd_reset_token</b>";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        if (!$mail->send()) {
                            $error = "Lỗi: " . $mail->ErrorInfo;
                            // echo '$error';
                        }
                        else {
                            echo "<p><center style=\"color: red\">Done!! mau mau vào mail kiểm tra mật khẩu đi nào. Lần này thì đừng quên nữa nhé <3 </center><p><br>";
                        }
                    } catch (Exception $e) {
                        // echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                    }
                }
            }
        }
        //render login form
        require_once("./Views/admin/login.php");
    ?>
</body>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>

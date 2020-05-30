<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        //render help site
        require_once("./Views/header.html");
        require_once("./Views/help.php");
    ?>
</body>
<br><br><br><br><br><br><br><br><br>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>
<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        require_once("./Views/header.html");
        require_once("./Models/M_product.php");
        //control get data detail product 
        if(isset($_GET['id'])){
            $modelProduct = new Model_product();
            $product = $modelProduct->getProductID($_GET['id']);
            $product = $product[0];
            
        }
        if(empty($product)) echo "<h1><center>Có vẻ như không có gì ở đây cả, đi thôi!</center></h1>";
        //render detail product
        else{
            $images = $modelProduct->getImageProduct($_GET['id']);
            $colors = $modelProduct->getColorProduct($_GET['id']);
            $inGio = $modelProduct->productInGio($_GET['id'], $_SESSION['id_customer']);
            require_once("./Views/detail.php");
        } 
    ?>
</body>
<footer>
<?php require_once("./Views/footer.php"); ?>
</footer>

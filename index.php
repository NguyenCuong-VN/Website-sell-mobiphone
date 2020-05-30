<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- content body -->
    <?php 
        require_once("./Views/header.html");
        require_once("./Models/M_product.php");
        
        //load data search category
        if(isset($_GET['id_cate'])){
            $modelProduct = new Model_product();
            $productList = $modelProduct->getProductCategory($_GET['id_cate']);
        }
        //load data search product
        elseif(isset($_GET['search'])){
            $modelProduct = new Model_product();
            $productList = $modelProduct->searchProduct($_GET['search']);
            
        }
        //load data all product
        else{
            $modelProduct = new Model_product();
            $productList = $modelProduct->getAllProduct();
        }
        //render content from data
        if(empty($productList)) echo "<h1><center>Hmm...Hiện tại chúng mình chưa có các sản phẩm này, bạn quay lại sau nhé <3 </center></h1>";
        else require_once("./Views/index.php");
        
    ?>
    <br>
    <!--end content body -->
</body>
<footer>
    <!-- content footer -->
    <?php require_once("./Views/footer.php"); ?>
</footer>
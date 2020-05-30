<?php 
    session_start();
    require_once("./Models/M_product.php");
    //control get product into gio
    if(isset($_POST['idpro']) && isset($_POST['idcus'])){
        $model_product = new Model_product();
        $create = $model_product->intoGio($_POST['idpro'], $_POST['idcus']);
        if($create == '3') echo "Lỗi mất rồi, thử lại sau vậy!";
        elseif($create == '1') echo "Cái này có rồi mà ta??";
        else echo "Mình bỏ nó vào giỏ rồi nhé. What's next??";
    }
    //control delete product from gio
    if(isset($_POST['gio_del_pro']) && $_POST['gio_del_cus']){
        $model_product = new Model_product();
        $delete = $model_product->deleteProductInGio($_POST['gio_del_pro'], $_POST['gio_del_cus']);
        if($delete == 1) echo "Đã xóa!";
        else echo "Hệ thống gặp sự cố, vui lòng thử lại sau!";
    }
?>
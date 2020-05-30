<style type="text/css">
body {  
font-family:Arial, Helvetica, sans-serif;   
overflow-x: hidden;
}
 
img {   
max-width: 100%;
}
 
.preview {  
display: -webkit-box;   
display: -webkit-flex;  
display: -ms-flexbox;   
display: flex;  
-webkit-box-orient: vertical;   
-webkit-box-direction: normal;  
-webkit-flex-direction: column; 
-ms-flex-direction: column; 
flex-direction: column;
} 
 
@media screen and (max-width: 996px) { 
.preview { 
margin-bottom: 20px;
}
}
 
.preview-pic {  
-webkit-box-flex: 1;    
-webkit-flex-grow: 1;   
-ms-flex-positive: 1;   
flex-grow: 1;
}
 
.preview-thumbnail.nav-tabs {   
border: none;   
margin-top: 15px;
}
 
.preview-thumbnail.nav-tabs li {    
width: 18%; 
margin-right: 2.5%;
}
 
.preview-thumbnail.nav-tabs li img {    
max-width: 100%;    
display: block;
}
 
.preview-thumbnail.nav-tabs li a {  
padding: 0; 
margin: 0;  
cursor:pointer;
}
 
.preview-thumbnail.nav-tabs li:last-of-type {   
margin-right: 0;
}
 
.tab-content {  
overflow: hidden;
}
 
.tab-content img {  
width: 100%;    
-webkit-animation-name: opacity;    
animation-name: opacity; 
-webkit-animation-duration: .3s; 
animation-duration: .3s;
}
 
.card { 
margin-top: 0px;    
background: #eee;   
padding: 3em;   
line-height: 1.5em;
} 
 
@media screen and (min-width: 997px) { 
.wrapper { 
display: -webkit-box; 
display: -webkit-flex; 
display: -ms-flexbox; 
display: flex;
}
}
 
.details {  
display: -webkit-box;
    display: -webkit-flex;  
display: -ms-flexbox;   
display: flex;  
-webkit-box-orient: vertical;   
-webkit-box-direction: normal;  
-webkit-flex-direction: column; 
-ms-flex-direction: column; 
flex-direction: column;
}
 

 
.product-title, .price, .sizes, .colors {   
text-transform: UPPERCASE;  
font-weight: bold;
}
 
.checked, .price span { 
color: #ff9f1a;
}
 
.product-title, .rating, .product-description, .price, .vote, .sizes {  
margin-bottom: 15px;
}
 
.product-title {    
margin-top: 0;
}
 
.size {
    margin-right: 10px;
}
 
.size:first-of-type {   
margin-left: 40px;
}
 
.color {    
display: inline-block;  
vertical-align: middle; 
margin-right: 10px; 
height: 2em;    
width: 2em; 
border-radius: 2px;
}
 
.color:first-of-type {  
margin-left: 20px;
}
 
.add-to-cart, .like {   
background: #ff9f1a;    
padding: 1.2em 1.5em;   
border: none;   
text-transform: UPPERCASE;  
font-weight: bold;  
color: #fff;    
text-decoration:none; 
-webkit-transition: background .3s ease; 
transition: background .3s ease;
}
 
.add-to-cart:hover, .like:hover {   
background: #b36800;    
color: #fff;    
text-decoration:none;
}
 
.not-available {    
text-align: center; 
line-height: 2em;
}
 
.not-available:before { 
font-family: fontawesome;   
content: "\f00d";   
color: #fff;
}
 
.orange {   
background: #ff9f1a;
}
 
.green {    
background: #85ad00;
}
 
.blue { 
background: #0076ad;
}
 
.tooltip-inner {    
padding: 1.3em;
} 
 
@-webkit-keyframes opacity { 
0% { opacity: 0; -webkit-transform: scale(3); transform: scale(3);} 
100% { opacity: 1; -webkit-transform: scale(1); transform: scale(1);}
} 
 
@keyframes opacity { 
0% { opacity: 0; -webkit-transform: scale(3); transform: scale(3);} 
100% { opacity: 1; -webkit-transform: scale(1); transform: scale(1);}
}
</style>
<br>
<!-- detail product -->
<div class="container">
    <div class="card">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1">
                            <?php echo "<img src=\"http://localhost/dienthoaididong/".$images[0]."\"".">"; ?>
                        </div>
                        <div class="tab-pane" id="pic-2">
                        <?php echo "<img src=\"http://localhost/dienthoaididong/".$images[1]."\"".">"; ?>
                        </div>
                        <div class="tab-pane" id="pic-3">
                        <?php echo "<img src=\"http://localhost/dienthoaididong/".$images[2]."\"".">"; ?>
                        </div>
                        <div class="tab-pane" id="pic-4">
                        <?php echo "<img src=\"http://localhost/dienthoaididong/".$images[3]."\"".">"; ?>
                        </div>
                        <div class="tab-pane" id="pic-5">
                        <?php echo "<img src=\"http://localhost/dienthoaididong/".$images[4]."\"".">"; ?>
                        </div>
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active">
                            <a data-target="#pic-1" data-toggle="tab"><?php echo "<img src=\"http://localhost/dienthoaididong/".$images[0]."\"".">"; ?></a>
                        </li>
                        <li>
                            <a data-target="#pic-2" data-toggle="tab"><?php echo "<img src=\"http://localhost/dienthoaididong/".$images[1]."\"".">"; ?></a>
                        </li>
                        <li>
                            <a data-target="#pic-3" data-toggle="tab"><?php echo "<img src=\"http://localhost/dienthoaididong/".$images[2]."\"".">"; ?></a>
                        </li>
                        <li>
                            <a data-target="#pic-4" data-toggle="tab"><?php echo "<img src=\"http://localhost/dienthoaididong/".$images[3]."\"".">"; ?></a>
                        </li>
                        <li>
                            <a data-target="#pic-5" data-toggle="tab"><?php echo "<img src=\"http://localhost/dienthoaididong/".$images[4]."\"".">"; ?></a>
                        </li>
                    </ul>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?php echo $product->name; ?></h3>
                    <p class="product-description"><?php echo $product->content; ?></p>
                    <h4 class="price"><span style="color:green">Giá bán:</span> <?php echo $product->sale_price; if($product->percent_sale != 0){echo "   sale $product->percent_sale ";}  ?></h4>
                    <h5 class="sizes"><span style="color:green">Số lượng:</span> <span id="soluong"><?php echo $product->amount; ?></span></h5>
                    <h5 class="sizes"><span style="color:green">Màu: </span>
                        <?php  
                            foreach($colors as $i){
                                echo "<span class=\"size\" data-toggle=\"tooltip\">$i</span>";
                            }
                        ?>
                    </h5> 
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button" onclick="mua()">MUA NGAY</button>
                        <button class="like btn btn-default" type="button" onclick="add()">
                            <?php   if($inGio == true) echo "Đã trong giỏ";
                                    else echo "Giỏ";
                            ?> 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<script>
    //add product into gio hang
    function add(){
        let product = '<?php echo $_GET['id'] ?>';
        let customer = '<?php echo $_SESSION['id_customer'] ?>';
        if(customer == ""){
            location = 'http://localhost/dienthoaididong/login.php';
        }
        else{
            $.ajax({
                url: 'http://localhost/dienthoaididong/giohang.php',
                type: 'POST',
                data:{
                    idpro: product,
                    idcus: customer
                }
            }).done(function(ketqua){
                alert(ketqua);
                location.reload();
            });
        }
    }
    //redirect site to thanh toan site
    function mua(){
        if(<?php echo $product->amount ?> != 0 ){
            location="http://localhost/dienthoaididong/thanhtoan.php?id=<?php echo $product->id ?>"
        }
        else alert("Sản phẩm hiện đang hết hàng!");
        
    }
    
</script>
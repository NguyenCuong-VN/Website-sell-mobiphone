
<!-- slide -->
<div class=container>
    <div id="myCarousel" class="carousel slide border" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="http://localhost/dienthoaididong/image/slide-galaxy-a51.png" alt="galaxy-a51" style="cursor: pointer" onclick="Redirect(this.id)" id="3">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/dienthoaididong/image/slide-iphone-7plus.png" alt="iphone-7plus" style="cursor: pointer" onclick="Redirect(this.id)" id="1">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/dienthoaididong/image/slide-oppo-reno-2f.png" alt="oppo-reno-2f" style="cursor: pointer" onclick="Redirect(this.id)" id="2">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="http://localhost/dienthoaididong/image/slide-vivo-y50.png" alt="vivo-y50" style="cursor: pointer" onclick="Redirect(this.id)" id="4">
        </div>
    </div>
    <!-- Controls slide-->
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>
<script type="text/javascript">
    function Redirect(id) {
        window.location="http://localhost/dienthoaididong/detail.php?id="+id;
    }
    
</script>


<!-- hien thi san pham -->

<style type="text/css">
    .product {  
    padding: 0px;   
    position: relative; 
    overflow: hidden;   
    height: 230px;  
    border: 1px solid #EAEAEA;  
    font-family: Arial, Helvetica, sans-serif;  
    font-size: 16px;
    }
     
    .product:hover .caption {   
    opacity: 1; 
    transform: translateY(-150px);  
    }
     
    .product img {  
    z-index: 4;
    }
     
    .product .caption { 
    position: absolute; 
    top:170px;  
    transition:all 0.3s ease-in-out;    
    width: 100%;
    }
     
    .product .blur {    
    background-color: rgba(0, 0, 0, 0.7);   
    height: 300px;  
    z-index: 5; 
    position: absolute; 
    width: 100%;
    }
    .product .caption-text {    
    z-index: 10;    
    color: #fff;    
    position: absolute; 
    height: 300px;  
    text-align: center; 
    top:-20px;  
    width: 100%;
    }</style>

<br>
<?php 
    echo "<div class=\"container\"> ";
    $count=0;
    foreach($productList as $i){
        if($count%4 == 0){
            if($count == 0){
                echo "<div class=\"row\">";
            }
            else{
                echo "
                    </div>
                    <br>
                    <div class=\"row\">
                ";
            }
        }
        echo "
        <div class=\"col-sm-6 col-md-3\"> 
            <div class=\"product\"> 
                <p style=\"text-align:center;margin-top:20px;\"> <img style=\"width: 100%\" src=\"http://localhost/dienthoaididong/$i->image_thumbnail\" class=\"img-responsive\" alt=\"$i->name\"> </p> 
                <div class=\"caption\"> 
                    <div class=\"blur\"></div> 
                    <div class=\"caption-text\"> 
                        <h3 style=\"border-top:2px solid white;border-bottom:2px solid white;padding:10px;\">$i->name</h3> 
                        <p>$i->sale_price</p> <a class=\" btn btn-default\" href=\"http://localhost/dienthoaididong/detail.php?id=$i->id\"><span class=\"glyphicon glyphicon-shopping-cart\"> Chi tiết</span></a> 
                    </div> 
                </div> 
            </div> 
        </div>
        ";
        $count++;
    }
    echo "</div>";
    echo "</div>";
?> 


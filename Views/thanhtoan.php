<br><br><br>
<h2 class="text-center"><strong style="color:green">Thanh toán</strong></h2>
<br>
<!-- bar process order -->
<center>
<div class="progress" style="height:20px; width: 1000px;">
    <div class="progress-bar progress-bar-striped progress-bar-animated"
        role="progressbar"
        aria-valuenow="80"
        aria-valuemin="0" aria-valuemax="100"
        style="width:0%" id="bar">
        0%
    </div>
</div>
</center>
<br><br><br>
<!-- table all product order -->
<div class="container" id="change-content">
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 50%;">Tên sản phẩm</th>
                <th style="width: 10%;" >Giá</th>
                <th style="width: 8%;" class="text-center">Số lượng</th>
                <th style="width: 22%;" class="text-center">Thành tiền</th>
                <th style="width: 10%;">Sửa</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                $total=0;
                foreach($products as $row){
                    $price_num=str_replace( '.', '', $row->sale_price );
                    $total+=(int)$price_num;
                    $i=$price_num.'_'.'1'.'_'.$row->id;
                    $noidung =substr($row->content, 0, 25).'...';
                    echo "<tr id=\"row-$row->id\">";
                    echo    "<td data-th=\"Product\">";
                    echo        "<div class=\"row\">";
                    echo            "<div class=\"col-sm-3 hidden-xs\"><img src=\"http://localhost/dienthoaididong/$row->image_thumbnail\" alt=\"$row->name\" class=\"img-responsive\" width=\"100\" /></div>";
                    echo            "<div class=\"col-sm-9\">";
                    echo                "<h4 class=\"nomargin\">$row->name</h4>";
                    echo               " <p>$noidung</p>";
                    echo            "</div>";
                    echo        "</div>";
                    echo    "</td>";
                    echo    "<td data-th=\"Price\">$row->sale_price đ</td>";
                    echo   " <td data-th=\"Quantity\"><input class=\"form-control text-center\" value=\"1\" type=\"number\" / min=\"0\" id=\"$i\" onchange=\"changePrice(this.id)\"></td>";
                    echo    "<td data-th=\"Subtotal\" class=\"text-center\" id=\"$row->id\">$row->sale_price đ</td>";
                    echo    "<td class=\"actions\" data-th=\"Edit\">";
                    echo        "<button class=\"btn btn-info btn-sm\" value=\"$row->id\" onclick=\"delProductThanhToan(this.value)\">Xóa</button>";
                    echo   " </td>";
                    echo "</tr>";

                }
            ?>

        </tbody>
        <tfoot>
            <tr>
                <td>
                    <a href="http://localhost/dienthoaididong/index.php" class="btn btn-warning">Tiếp tục mua hàng</a>
                </td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Tổng tiền <strong id="total"><?php echo $total ?></strong> đ</strong></td>
                <td>
                    <button class="btn btn-success btn-block" onclick="thanhtoan()">Thanh toán</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<br><br><br><br>
<script>
    // delete product from order
    function delProductThanhToan(idProduct){
        let price = $('#'+idProduct).text();
        price=price.replace(/\./g,'');
        price=price.replace(/ /g,'');
        price=price.replace(/đ/g,'');
        price = parseInt(price);
        let total= parseInt($('#total').text());
        total=total-price;
        $('#total').text(total);
        $.ajax({
            url: 'http://localhost/dienthoaididong/thanhtoan.php',
            type: 'GET',
            data: {
                delId: idProduct
            }
        }).done(function(ketqua){
        });
        $('#row-'+idProduct).remove();
    }
    //control change price khi change so luong product
    function changePrice(inf){
        let x = inf.split('_');
        let count_new = $('#'+inf).val();
        let don_gia=parseInt(x[0]);
        let count_old = parseInt(x[1]);
        let price_new = don_gia*count_new;
        let price_new_string=price_new.toString();
        let price = '';
        for(let i=price_new_string.length-1; i>=0; i=i-3){
            if(i>=3) price='.'+price_new_string[i-2]+price_new_string[i-1]+price_new_string[i]+price;
            if(i==2) price=price_new_string[i-2]+price_new_string[i-1]+price_new_string[i]+price;
            if(i==1) price=price_new_string[i-1]+price_new_string[i]+price;
            if(i==0) price=price_new_string[i]+price;
        }
        price = price+' đ';
        $('#'+x[2]).text(price);
        
        let fix= price_new-(don_gia*count_old);
        let total= parseInt($('#total').text());
        total= total+fix;
        $('#total').text(total);
        let new_id= x[0]+'_'+count_new.toString()+'_'+x[2];
        $('#'+inf).attr('id', new_id);
    }
    //control thanh toan va next sang process tiep theo
    function thanhtoan(){
        let price= $('#total').text();
        $.ajax({
            url: 'http://localhost/dienthoaididong/thanhtoan.php',
            type: 'GET',
            dataType: 'html',
            data:{
                thanhtoan: 'thanhtoan',
                total: price
            }
        }).done(function(ketqua){
            if(ketqua == 1){
                $('#change-content').html('<div class="alert alert-danger">Không có sản phẩm nào để thanh toán!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                $('#bar').attr('style', 'width:100%');
                $('#bar').text('100%');
            }
            else{
                $('#change-content').html(ketqua);
                $('#bar').attr('style', 'width:50%');
                $('#bar').text('50%');
            }
        });
        
    }

</script>
<br><br><br>
<!-- table don hang -->
<h2 class="text-center"><strong style="color:green">Đơn hàng</strong></h2>
<br>
<div class="container">
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 20%;" class="text-center">Mã đơn hàng</th>
                <th style="width: 20%;" class="text-center">Trạng thái</th>
                <th style="width: 30%;" class="text-center">Chi phí</th>
                <th style="width: 30%;" class="text-center">Ngày mua hàng</th>
            </tr>
        </thead>
        <tbody>

            <?php 
                foreach($order as $row){
                    echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                    echo    "<td data-th=\"ID\" class=\"text-center\">$row->id </td>";
                    echo    "<td data-th=\"Trangthai\" class=\"text-center\">$row->id_status_order</td>";
                    echo    "<td data-th=\"Total\" class=\"text-center\">$row->total_price đ</td>";
                    echo    "<td data-th=\"Date\" class=\"text-center\">$row->create_at</td>";
                    echo "</tr>";
                }
            ?>

        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
    <br><br>
    <div id="detail">
        
    </div>           

</div>
<script>
    //get detail order
    function  detail(idOrder) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/donHang.php",
            data:{
                idOder: idOrder
            },
            success: function (response) {
                $('#detail').html(response);
                location='#donhang';
            }
        });
    }
</script>

<br><br><br><br><br><br><br><br><br>

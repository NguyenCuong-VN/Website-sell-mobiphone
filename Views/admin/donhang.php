<br><br><br>

<h2 class="text-center"><strong style="color:brown">Đơn hàng</strong></h2>
<br>
<!--seach bar  -->
<div class="container">
    <div id="alert"></div>
    <br>
    <div class="row" >
        <div class="col-md-2">
            <select id="ngay" class="form-control">
                <option value="%" selected>Ngày</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="thang" class="form-control">
                <option value="%" selected>Tháng</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="col-md-2">
            <select id="nam" class="form-control">
                <option value="%" selected>Năm</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
        </div>    
        <div class="col-md-2">
            <select id="trangthaiorder" class="form-control">
                <option value="" selected>Trạng thái</option>
                <option value="1">Hàng đợi</option>
                <option value="2">Xác nhận</option>
                <option value="3">Đang gói hàng</option>
                <option value="4">Đang giao hàng</option>
                <option value="5">Hoàn thành</option>
                <option value="6">Đã hủy</option>
            </select>
        </div>
        <div class="col-md-3">
            <input class="form-control ml-sm-2" type="text" placeholder="Tìm kiếm ID..." id="searchInput">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" type="button" onclick="search()">Search</button>
        </div>
    </div>
    <br>
    <!--table all order -->
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 5%;" class="text-center">STT</th>
                <th style="width: 10%;" class="text-center">Mã đơn hàng</th>
                <th style="width: 10%;" class="text-center">Mã khách hàng</th>
                <th style="width: 15%;" class="text-center">Trạng thái</th>
                <th style="width: 20%;" class="text-center">Chi phí</th>
                <th style="width: 30%;" class="text-center">Ngày mua hàng</th>
                <th style="width: 10%;" class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody id="contentSearch">
                <?php 
                    $i=1;
                    foreach($order as $row){
                        echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                        echo    "<td data-th=\"STT\" class=\"text-center\">$i </td>";
                        echo    "<td data-th=\"IDorder\" class=\"text-center\">$row->id </td>";
                        echo    "<td data-th=\"IDcustomer\" class=\"text-center\">$row->id_customer </td>";
                        echo    "<td data-th=\"Trangthai\" class=\"text-center\" id=\"$row->id-1\">$row->id_status_order</td>";
                        echo    "<td data-th=\"Total\" class=\"text-center\">$row->total_price đ</td>";
                        echo    "<td data-th=\"Date\" class=\"text-center\">$row->create_at</td>";
                        echo    "<td data-th=\"edit\" class=\"text-center\"><button class=\"btn btn-info btn-sm\" value=\"$row->id\" id=\"$row->id-edit\" name=\"edit\" onclick=\"editOrder(this.value, this.id)\">Edit</button></td>";
                        echo "</tr>";
                        $i++;
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
    function detail(idOrder) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/donHang.php",
            data:{
                idOderAdmin: idOrder,
            },
            success: function (response) {
                $('#detail').html(response);
                location='#donhang';
            }
        });
    }
    //change status order
    function editOrder(idOrder, id){
        if($('#'+id).text() == 'Edit'){
            $('#'+idOrder+'-1').html('<select id="editsttus"><option value="1">Hàng đợi</option><option value="2">Xác nhận</option><option value="3">Đang gói hàng</option><option value="4">Đang giao hàng</option><option value="5">Hoàn thành</option><option value="6">Đã hủy</option></select>');
            $('#'+id).text('Save');
        }
        else{
            $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/donHang.php",
            data:{
                idStatus: $('#editsttus').val(),
                idOrder: idOrder
            },
            success: function (response) {
                if(response == 1){
                    $('#alert').html('<div class="alert alert-success">Trạng thái đã được cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+idOrder+'-1').html($('#editsttus :selected').text());
                    $('#'+id).text('Edit');
                }
                else if(response == 2){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else{
                    $('#alert').html('<div class="alert alert-danger">Bạn không có đủ quyền thực hiện tác vụ này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }

            }
        });
        }
    }
    //search order
    function search() {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/donHang.php",
            data:{
                searchOrder: 'search',
                date: $('#ngay').val(),
                month: $('#thang').val(),
                year: $('#nam').val(),
                status: $('#trangthaiorder').val(),
                ID: $('#searchInput').val()
            },
            dataType: "html",
            success: function (response) {
                $('#contentSearch').html(response);
            }
        });
    }
</script>

<br><br><br><br><br><br><br><br><br>


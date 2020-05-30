
<br><br><br>

<h2 class="text-center"><strong style="color:brown">Sản phẩm</strong></h2>
<br>
<!--seach bar-->
<div class="container">
    <div id="alert"></div>
    <br>
    <div class="row" >
        <div class="col-md-2 ">
            <button class="btn btn-success" type="button" onclick="newProduct()">Thêm mới</button>
        </div>
        <div class="col-md-2 offset-3">
            <select id="thuonghieuproduct" class="form-control">
                <option value="">Tất cả</option>;
                <?php 
                    foreach($categorys as $row){
                        echo "<option value=\"$row->id\">$row->name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <input class="form-control ml-sm-2" type="text" placeholder="Tìm kiếm sản phẩm..." id="searchInput">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" type="button" onclick="search()">Search</button>
        </div>
    </div>
    <br>
    
    <!--table all product -->
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 5%;" class="text-center">STT</th>
                <th style="width: 10%;" class="text-center">Mã đơn hàng</th>
                <th style="width: 30%;" class="text-center">Tên sản phẩm</th>
                <th style="width: 15%;" class="text-center">Giá</th>
                <th style="width: 20%;" class="text-center">Thương hiệu</th>
                <th style="width: 20%;" class="text-center">Số lượng</th>
            </tr>
        </thead>
        <tbody id="contentSearch">
                <?php 
                    $i=1;
                    foreach($products as $row){
                        echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                        echo    "<td data-th=\"STT\" class=\"text-center\">$i </td>";
                        echo    "<td data-th=\"IDproduct\" class=\"text-center\">$row->id </td>";
                        echo    "<td data-th=\"name\" class=\"text-center\">$row->name </td>";
                        echo    "<td data-th=\"Price\" class=\"text-center\">$row->price</td>";
                        echo    "<td data-th=\"Category\" class=\"text-center\">$row->category_id</td>";
                        echo    "<td data-th=\"Amount\" class=\"text-center\">$row->amount</td>";
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
    <br>        

</div>
<script>
    //change info product
    function check(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    saveproduct: 'save',
                    masanpham: $('#masanpham').text(),
                    tensp: $('#tensp').val(),
                    noidungsp: $('#noidungsp').val(),
                    giasp: $('#giasp').val(),
                    giamsp: $('#giamsp').val(),
                    giagiamsp: $('#giagiamsp').val(),
                    soluongsp: $('#soluongsp').val(),
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Trường số lượng phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#tensp').prop('disabled', true);
                    $('#noidungsp').prop('disabled', true);
                    $('#giasp').prop('disabled', true);
                    $('#giamsp').prop('disabled', true);
                    $('#giagiamsp').prop('disabled', true);
                    $('#soluongsp').prop('disabled', true);
                } 
            });
        }
        else{
            $('#tensp').prop('disabled', false);
            $('#noidungsp').prop('disabled', false);
            $('#giasp').prop('disabled', false);
            $('#giamsp').prop('disabled', false);
            $('#giagiamsp').prop('disabled', false);
            $('#soluongsp').prop('disabled', false);
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //get info detail product
    function detail(idproduct) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                idproduct: idproduct,
            },
            success: function (response) {
                $('#detail').html(response);
                location='#sanpham';
            }
        });
    }
    //get info product search
    function search() {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                searchProduct: 'search',
                thuonghieuproduct: $('#thuonghieuproduct').val(),
                name: $('#searchInput').val()
            },
            dataType: "html",
            success: function (response) {
                $('#contentSearch').html(response);
            }
        });
    }
    //get form create product
    function newProduct() {
        $('#detail').html("<div class=\"alert alert-success\" id=\"sanpham\"> \
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" >x</button>\
                <br>\
                <form action=\"http://localhost/dienthoaididong/manageradmin.php\" method=\"post\" enctype=\"multipart/form-data\">\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Tên sản phẩm:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <input class=\"form-control\" name=\"new_ten\" type=\"text\" value=\"\">\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Nội dung:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <textarea class=\"form-control\" rows=\"7\" name=\"new_noidung\"></textarea>\
                            <br>\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Giá:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <input class=\"form-control\" name=\"new_gia\" type=\"text\" value=\"\">\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Giảm giá:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <input class=\"form-control\" name=\"new_giamgia\" type=\"text\" value=\"\">\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Giá sau giảm:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <input class=\"form-control\" name=\"new_giasaugiam\" type=\"text\" value=\"\">\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Thương hiệu:</b></label>\
                        </div>\
                        <div class=\"col-3\">\
                            <select name=\"new_thuonghieu\" class=\"form-control\">\
                                <option value=\"1\">Iphone</option>\
                                <option value=\"2\">Samsung</option>\
                                <option value=\"3\">Oppo</option>\
                                <option value=\"4\">Vivo</option>\
                                <option value=\"5\">Xiaomi</option>\
                                <option value=\"6\">Huawei</option>\
                                <option value=\"7\">Realme</option>\
                            </select>\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Số lượng:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                        <input class=\"form-control\" name=\"new_soluong\" type=\"text\" value=\"\">\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-3 offset-2\">\
                            <label for=\"ten\"><b>Chọn ảnh:</b></label>\
                        </div>\
                        <div class=\"col-4\">\
                            <input name=\"fileupload[]\" type=\"file\" multiple />\
                        </div>\
                    </div>\
                    <br>\
                    <div class=\"row\">\
                        <div class=\"col-1 offset-5\">\
                            <button type=\"submit\" class=\"btn btn-warning\" name=\"new_button\">Lưu</button>\
                        </div>\
                    </div>\
                </form>\
            </div>");
    }
</script>

<br><br><br><br><br><br><br><br><br>


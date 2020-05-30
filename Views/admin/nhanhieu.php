<br><br><br>

<h2 class="text-center"><strong style="color:brown">Thương hiệu</strong></h2>
<br>
<!--search bar-->
<div class="container">
    <div id="alert"></div>
    <br>
    <div class="row" >
        <div class="col-md-2 ">
            <button class="btn btn-success" type="button" onclick="newCategory()">Thêm mới</button>
        </div>
        <div class="col-md-4 offset-5">
            <input class="form-control ml-sm-2" type="text" placeholder="Tìm kiếm thương hiệu..." id="searchInput">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" type="button" onclick="search()">Search</button>
        </div>
    </div>
    <br>
    
    <!--table all category -->
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 10%;" class="text-center">STT</th>
                <th style="width: 10%;" class="text-center">Mã thương hiệu</th>
                <th style="width: 30%;" class="text-center">Tên thương hiệu</th>
                <th style="width: 20%;" class="text-center">Số lượng</th>
                <th style="width: 30%;" class="text-center">Ngày cập nhật</th>
            </tr>
        </thead>
        <tbody id="contentSearch">
                <?php 
                    $i=1;
                    foreach($categories as $row){
                        $mount = $amountCate[$row->id];
                        echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                        echo    "<td data-th=\"STT\" class=\"text-center\">$i </td>";
                        echo    "<td data-th=\"IDcate\" class=\"text-center\">$row->id </td>";
                        echo    "<td data-th=\"name\" class=\"text-center\">$row->name </td>";
                        echo    "<td data-th=\"Amount\" class=\"text-center\">$mount</td>";
                        echo    "<td data-th=\"Date\" class=\"text-center\">$row->update_at</td>";
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
    //change info category
    function check(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    savecategory: 'save',
                    mathuonghieu: $('#mathuonghieu').text(),
                    tenthuonghieu: $('#tenthuonghieu').val(),
                    noidungthuonghieu: $('#noidungthuonghieu').val(),
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Trường mã thương hiệu phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#tenthuonghieu').prop('disabled', true);
                    $('#noidungthuonghieu').prop('disabled', true);
                } 
            });
        }
        else{
            $('#tenthuonghieu').prop('disabled', false);
            $('#noidungthuonghieu').prop('disabled', false);
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //get detail info category
    function detail(idcate) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                idcate: idcate,
            },
            success: function (response) {
                $('#detail').html(response);
                location='#sanpham';
            }
        });
    }
    //search category
    function search() {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                searchCategory: 'search',
                name: $('#searchInput').val()
            },
            dataType: "html",
            success: function (response) {
                $('#contentSearch').html(response);
            }
        });
    }
    //get form create category
    function newCategory() {
        $('#detail').html("<div class=\"alert alert-success\" id=\"sanpham\">\
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">x</button>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Tên thương hiệu:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"tenthuonghieu\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Mô tả:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <textarea class=\"form-control\" rows=\"4\" id=\"noidungthuonghieu\"></textarea>\
                                    <br>\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-1 offset-5\">\
                                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"createCategory()\">Lưu</button>\
                                </div>\
                            </div>\
                        </div>");
    }
    //create category
    function createCategory() {
        $.ajax({
            type: "POST",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                new_category: 'create',
                new_thuonghieu: $('#tenthuonghieu').val(),
                new_noidungthuonghieu: $('#noidungthuonghieu').val(),
            },
            success: function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-success">Thương hiệu mới đã được tạo. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                } 
                location="#alert";
            }
        });
    }
</script>

<br><br><br><br><br><br><br><br><br>



<br><br><br>

<h2 class="text-center"><strong style="color:brown">Chức danh</strong></h2>
<br>
<!--search bar -->
<div class="container">
    <div id="alert"></div>
    <br>
    <div class="row" >
        <div class="col-md-2 ">
            <button class="btn btn-success" type="button" onclick="newPosition()">Thêm mới</button>
        </div>
        <div class="col-md-4 offset-5">
            <input class="form-control ml-sm-2" type="text" placeholder="Tìm kiếm chức vụ..." id="searchInput">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" type="button" onclick="search()">Search</button>
        </div>
    </div>
    <br>

    <!--table all position -->
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 10%;" class="text-center">STT</th>
                <th style="width: 20%;" class="text-center">Mã chức vụ</th>
                <th style="width: 25%;" class="text-center">Tên chức vụ</th>
                <th style="width: 45%;" class="text-center">Mô tả</th>
            </tr>
        </thead>
        <tbody id="contentSearch">
                <?php 
                    $i=1;
                    foreach($positions as $row){
                        echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                        echo    "<td data-th=\"STT\" class=\"text-center\">$i </td>";
                        echo    "<td data-th=\"IDposition\" class=\"text-center\">$row->id </td>";
                        echo    "<td data-th=\"name\" class=\"text-center\">$row->name </td>";
                        echo    "<td data-th=\"description\" class=\"text-center\">$row->description</td>";
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
    //change info position
    function check(id) {
        if($('#'+id).val() == "save"){
            var checkbox = document.getElementsByName('permiss');
            var selectedbox=[];
                for (var i = 0; i < checkbox.length; i++){
                    if (checkbox[i].checked === true){
                        selectedbox.push(checkbox[i].value);
                    }
                }
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    savePermissionPosition: 'save',
                    machucdanh: $('#machucdanh').text(),
                    tenchucdanh: $('#tenchucdanh').val(),
                    mota: $('#mota').val(),
                    quyenhan: selectedbox
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Trường mã chức danh phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#tenchucdanh').prop('disabled', true);
                    $('#mota').prop('disabled', true);
                } 
            });
        }
        else{
            $('#tenchucdanh').prop('disabled', false);
            $('#mota').prop('disabled', false);
            $.ajax({
                type: "GET",
                url: "http://localhost/dienthoaididong/manageradmin.php",
                data:{
                    allPermission: 'all'
                },
                dataType: "html",
                success: function (response) {
                    $('#quyenhan').html(response);
                }
            });
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //get detail position
    function detail(idposition) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                idposition: idposition,
            },
            success: function (response) {
                $('#detail').html(response);
                location='#sanpham';
            }
        });
    }
    //search position
    function search() {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                searchPosition: 'search',
                name: $('#searchInput').val()
            },
            dataType: "html",
            success: function (response) {
                $('#contentSearch').html(response);
            }
        });
    }
    //form create position
    function newPosition() {
        $('#detail').html("<div class=\"alert alert-success\" id=\"sanpham\">\
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">x</button>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Tên chức danh:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"tenchucdanh\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Mô tả:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <textarea class=\"form-control\" rows=\"4\" id=\"motachucdanh\"></textarea>\
                                    <br>\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Quyền hạn:</b></label>\
                                </div>\
                                <div class=\"col-4\" id=\"setquyenhan\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-1 offset-5\">\
                                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"createPosition()\">Lưu</button>\
                                </div>\
                            </div>\
                        </div>");
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                allPermission: 'all'
                },
            dataType: "html",
            success: function (response) {
            $('#setquyenhan').html(response);
            }
        });
    }
    //create position
    function createPosition() {
        var checkbox = document.getElementsByName('permiss');
            var selectedbox=[];
                for (var i = 0; i < checkbox.length; i++){
                    if (checkbox[i].checked === true){
                        selectedbox.push(checkbox[i].value);
                    }
                }
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    new_Position: 'create',
                    tenchucdanh: $('#tenchucdanh').val(),
                    motachucdanh: $('#motachucdanh').val(),
                    quyenhan: selectedbox
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Trường mã chức danh phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                } 
            });
    }
</script>

<br><br><br><br><br><br><br><br><br>




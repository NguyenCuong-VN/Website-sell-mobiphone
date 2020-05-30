<br><br><br>

<h2 class="text-center"><strong style="color:brown">Nhân viên</strong></h2>
<br>
<!--search bar-->
<div class="container">
    <div id="alert"></div>
    <br>
    <div class="row" >
        <div class="col-md-2 ">
            <button class="btn btn-success" type="button" onclick="newUser()">Thêm mới</button>
        </div>
        <div class="col-md-4 offset-5">
            <input class="form-control ml-sm-2" type="text" placeholder="Tìm kiếm nhân viên..." id="searchInput">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" type="button" onclick="search()">Search</button>
        </div>
    </div>
    <br>
    
    <!-- table all user -->
    <table id="cart" class="table table-hover table-condensed">
        <thead class="thead-light">
            <tr>
                <th style="width: 10%;" class="text-center">STT</th>
                <th style="width: 10%;" class="text-center">Mã nhân viên</th>
                <th style="width: 30%;" class="text-center">Tên nhân viên</th>
                <th style="width: 20%;" class="text-center">ID nhân viên</th>
                <th style="width: 30%;" class="text-center">Chức vụ</th>
            </tr>
        </thead>
        <tbody id="contentSearch">
                <?php 
                    $i=1;
                    foreach($admins as $row){
                        echo "<tr id=\"$row->id\" onclick=\"detail(this.id)\">";
                        echo    "<td data-th=\"STT\" class=\"text-center\">$i </td>";
                        echo    "<td data-th=\"iduser\" class=\"text-center\">$row->id </td>";
                        echo    "<td data-th=\"name\" class=\"text-center\">$row->full_name </td>";
                        echo    "<td data-th=\"ID\" class=\"text-center\">$row->ID_employee_number</td>";
                        echo    "<td data-th=\"chucvu\" class=\"text-center\">$row->id_position</td>";
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
    //change user's position
    function check(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    saveuser: 'save',
                    chucvuuser: $('#selectposition').val(),
                    manhanvien: $('#manhanvien').text(),
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Trường mã phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                } 
            });
        }
        else{
            $.ajax({
                type: "GET",
                url: "http://localhost/dienthoaididong/manageradmin.php",
                data: {
                    allposition: 'allposition'
                },
                dataType: "html",
                success: function (response) {
                    $('#changeposition').html(response);
                }
            });
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //get detail user info
    function detail(iduser) {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                iduser: iduser,
            },
            success: function (response) {
                $('#detail').html(response);
                location='#sanpham';
            }
        });
    }
    //get data user search
    function search() {
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                searchUser: 'search',
                name: $('#searchInput').val()
            },
            dataType: "html",
            success: function (response) {
                $('#contentSearch').html(response);
            }
        });
    }
    //get form create user
    function newUser() {
        $('#detail').html("<div class=\"alert alert-success\" id=\"sanpham\">\
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">x</button>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Tên đăng nhập:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"username\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Mật khẩu:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"password\" type=\"password\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Nhập lại mật khẩu:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"repassword\" type=\"password\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Họ và tên:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"fullname\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Email:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"email\" type=\"email\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Số điện thoại:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"phone\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>Chức vụ:</b></label>\
                                </div>\
                                <div class=\"col-4\" id=\"chucvu\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-3 offset-2\">\
                                    <label for=\"ten\"><b>ID nhân viên:</b></label>\
                                </div>\
                                <div class=\"col-4\">\
                                    <input class=\"form-control\" id=\"IDnhanvien\" type=\"text\" value=\"\">\
                                </div>\
                            </div>\
                            <br>\
                            <div class=\"row\">\
                                <div class=\"col-1 offset-5\">\
                                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"createUser()\">Lưu</button>\
                                </div>\
                            </div>\
                        </div>");
        $.ajax({
            type: "GET",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data: {
                allposition: 'allposition'
            },
            dataType: "html",
            success: function (response) {
                $('#chucvu').html(response);
            }
        });
    }
    //create user
    function createUser() {
        $.ajax({
            type: "POST",
            url: "http://localhost/dienthoaididong/manageradmin.php",
            data:{
                new_user: 'create',
                username: $('#username').val(),
                password: $('#password').val(),
                repassword: $('#repassword').val(),
                fullname: $('#fullname').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                chucvu: $('#selectposition').val(),
                IDnhanvien: $('#IDnhanvien').val(),
            },
            success: function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Bạn không có quyền chỉnh sửa dữ liệu này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Số điện thoại phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Chức vụ phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-danger">Hai trường mật khẩu không trùng nhau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 8){
                    $('#alert').html('<div class="alert alert-danger">Email không đúng định dạng!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 6){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 7){
                    $('#alert').html('<div class="alert alert-success">User mới đã được tạo. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                } 
                location="#alert";
            }
        });
    }
</script>

<br><br><br><br><br><br><br><br><br>



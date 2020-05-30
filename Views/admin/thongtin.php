<br><br><br>
<!-- info admin -->
<h2 class="text-center"><strong style="color:brown">Thông tin</strong></h2>
<br><br>
<center><img src="http://localhost/dienthoaididong/image/admin_avartar.png" width="200px" height="200px" alt="avatar"></center>
<br><br><br>
<div class="container">
    <div id="alert">
    </div>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="ten"><b>Tên Admin:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="name_adm" type="text" value="<?php echo $_SESSION['name_admin'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="ngaytao"><b>Ngày tạo:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" value="<?php echo $_SESSION['create_at_admin'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="email""><b>Email:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="email_adm" type="email" value="<?php echo $_SESSION['email_admin'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="soId"><b>Số ID:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" value="<?php echo $_SESSION['ID_employee_number_admin'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="phone"><b>Số điện thoại:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="phone_adm" type="text" value="<?php echo $_SESSION['phone_admin'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="position"><b>Chức vụ:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" value="<?php echo $position->name ?>" disabled>
        </div>
    </div>
    <br>
    <div id="change_pas">
        
    </div>
    <br>
    <center>
        <button type="button" class="btn btn-warning" id="edit" value="edit" onclick="check(this.id)">Sửa</button>
        <button type="button" class="btn btn-warning" id="editpasswd" value="editpasswd" onclick="checkpasswd(this.id)">Đổi mật khẩu</button>
    </center>
    </div>
    
</div>
<br><br><br>

<script>
    //change admin info
    function check(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    save: 'save',
                    name_adm: $('#name_adm').val(),
                    email_adm: $('#email_adm').val(),
                    phone_adm: $('#phone_adm').val(),
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống tên, email hoặc số điện thoại!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Sai định dạng số điện thoại!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Sai định dạng email!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#name_adm').prop('disabled', true);
                    $('#email_adm').prop('disabled', true);
                    $('#phone_adm').prop('disabled', true);
                } 
            });
        }
        else{
            $('#name_adm').prop('disabled', false);
            $('#email_adm').prop('disabled', false);
            $('#phone_adm').prop('disabled', false);
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //change passwd admin
    function checkpasswd(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/manageradmin.php',
                type: 'POST',
                data:{
                    savepasswd: 'savepasswd',
                    old_passwd: $('#old_passwd').val(),
                    new_passwd: $('#new_passwd').val(),
                    renew_passwd: $('#renew_passwd').val(),
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống các trường!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Trường mật khẩu mới và nhập lại mật khẩu mới phải trùng nhau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Hiện tại tài khoản chưa được định dạng. Vui lòng đăng nhập lại!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Sai mật khẩu!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('editpasswd');
                    $('#'+id).text('Đổi mật khẩu');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#change_pas').html('');
                } 
            });
        }
        else{
            $('#change_pas').html('<div class="row"><div class="col-3 offset-2"><label for="address"><b>Mật khẩu hiện tại:</b></label></div><div class="col-4"><input class="form-control" id="old_passwd" type="text" ></div></div><br><div class="row"><div class="col-3 offset-2"><label for="phone"><b>Mật khẩu mới:</b></label></div><div class="col-4"><input class="form-control" id="new_passwd" type="text"></div></div><br><div class="row"><div class="col-3 offset-2"><label for="phone"><b>Nhập lại mật khẩu mới:</b></label></div><div class="col-4"><input class="form-control" id="renew_passwd" type="text"></div></div>');
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
</script>
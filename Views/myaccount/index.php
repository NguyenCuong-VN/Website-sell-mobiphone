<br><br><br>
<!-- info customer -->
<h2 class="text-center"><strong style="color:green">Thông tin</strong></h2>
<br><br>
<center><img src="http://localhost/dienthoaididong/image/customer_avatar.jpg" width="200px" height="200px" alt="avatar"></center>
<br><br><br>
<div class="container">
    <div id="alert">
    </div>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="ten"><b>Tên khách hàng:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="name_cus" type="text" value="<?php echo $_SESSION['name_customer'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="ngaytao"><b>Ngày tạo:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" value="<?php echo $_SESSION['create_at_customer'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="email""><b>Email:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="email_cus" type="email" value="<?php echo $_SESSION['email_customer'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="address"><b>Địa chỉ:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="address_cus" type="text" value="<?php echo $_SESSION['address_customer'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="phone"><b>Số điện thoại:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="phone_cus" type="text" value="<?php echo $_SESSION['phone_customer'] ?>" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-2">
            <label for="phone"><b>Số tài khoản:</b></label>
        </div>
        <div class="col-4">
            <input class="form-control" id="bank_cus" type="text" value="<?php echo $_SESSION['bank_customer'] ?>" disabled>
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
    //change info customer
    function check(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/myaccount.php',
                type: 'POST',
                data:{
                    save: 'save',
                    name_cus: $('#name_cus').val(),
                    email_cus: $('#email_cus').val(),
                    address_cus: $('#address_cus').val(),
                    phone_cus: $('#phone_cus').val(),
                    bank_cus: $('#bank_cus').val()
                }
            }).done(function (ketqua) {
                if(ketqua == 1){
                    $('#alert').html('<div class="alert alert-danger">Không được để trống tên khách hàng hoặc email!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 2){
                    $('#alert').html('<div class="alert alert-danger">Sai định dạng số điện thoại!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 3){
                    $('#alert').html('<div class="alert alert-danger">Sai định dạng số tài khoản!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 4){
                    $('#alert').html('<div class="alert alert-danger">Sai định dạng email!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 5){
                    $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                }
                else if(ketqua == 6){
                    $('#alert').html('<div class="alert alert-success">Thông tin đã được cập nhật. Vui lòng refresh lại trang để hiển thị thông tin cập nhật!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    $('#'+id).val('edit');
                    $('#'+id).text('Sửa');
                    $('#'+id).attr('class', 'btn btn-warning');
                    $('#name_cus').prop('disabled', true);
                    $('#email_cus').prop('disabled', true);
                    $('#address_cus').prop('disabled', true);
                    $('#phone_cus').prop('disabled', true);
                    $('#bank_cus').prop('disabled', true);
                } 
            });
        }
        else{
            $('#name_cus').prop('disabled', false);
            $('#email_cus').prop('disabled', false);
            $('#address_cus').prop('disabled', false);
            $('#phone_cus').prop('disabled', false);
            $('#bank_cus').prop('disabled', false);
            $('#'+id).val('save');
            $('#'+id).text('Lưu');
            $('#'+id).attr('class', 'btn btn-danger');
        }
    }
    //change passwd customer
    function checkpasswd(id) {
        if($('#'+id).val() == "save"){
            $.ajax({
                url: 'http://localhost/dienthoaididong/myaccount.php',
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

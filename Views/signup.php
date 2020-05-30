
    <br>
    <!-- form signup    -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-4">
                <h1 class="text-center" id="tieu_de" style="color:red">Đăng ký</h1>
                <br>
                <form method="POST" id="form_dang_ky" action="http://localhost/dienthoaididong/signup.php">
                    <fieldset>
                        <label >Họ tên:<span style="color:red">*</span></label><br>
                        <input class="form-control" value="" placeholder="Họ tên..." name="fullname" type="text">

                        <label >Số điện thoại:</label><br>
                        <input class="form-control" value="" placeholder="Số điện thoại..." name="phone" type="text">

                        <label >Email:<span style="color:red">*</span></label><br>
                        <input class="form-control" value="" placeholder="Email..." name="email" type="email">

                        <label >Địa chỉ:</label><br>
                        <input class="form-control" value="" placeholder="Địa chỉ..." name="address" type="text">

                        <label >Tên đăng nhập:<span style="color:red">*</span></label><br>
                        <input class="form-control" value="" placeholder="Tên đăng nhập..." name="username" type="text">

                        <label>Mật khẩu:<span style="color:red">*</span></label><br>
                        <input class="form-control" value="" placeholder="Mật khẩu..." name="password" type="password">

                        <label>Nhập lại mật khẩu:<span style="color:red">*</span></label><br>
                        <input class="form-control" value="" placeholder="Mật khẩu..." name="repassword" type="password">
 
                        <br> <center><button class="btn btn-info" type="submit" name="btn_signup">Đăng ký</button></center>
                    </fieldset>
                </form>             
            </div>
        </div>
    </div>
<br>
<br><br><br><br>
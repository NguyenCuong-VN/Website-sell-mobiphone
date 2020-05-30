    <!--form login admin -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 offset-4">
                <h1 class="text-center" id="tieu_de" style="color:green">Đăng nhập Admin</h1>
                <br>
                <form method="POST" action="http://localhost/dienthoaididong/loginadmin.php" id="form_dang_nhap">
                    <fieldset>
                        <label >Tên đăng nhập:</label><br>
                        <input class="form-control" value="" placeholder="Tên đăng nhập..." name="username" type="text">

                        <label>Mật khẩu:</label><br>
                        <input class="form-control" value="" placeholder="Mật khẩu..." name="password" type="password">

                        <br> <button class="btn btn-info" type="submit" name="btn_submit">Đăng nhập</button>
                    </fieldset>
                </form>    
                <br>
                <br> <label style="color:#007bff; cursor: pointer" onclick="QuenMatKhau()" id="quen_mat_khau">Quên mật khẩu</label>
                
            </div>
        </div>
    </div>

    <!--load form forgot passwd -->
    <script type="text/javascript">
        function QuenMatKhau(){
            $("#form_dang_nhap").after("<br><form method=\"POST\" action=\"http://localhost/dienthoaididong/loginadmin.php\"><label >Tên đăng nhập:</label><br><input class=\"form-control\" value=\"\" placeholder=\"Tên đăng nhập...\" name=\"username_forgot\" type=\"text\"><button class=\"btn btn-info\" type=\"submit\" name=\"btn_forgot\">Reset mật khẩu</button></form>")  
        }
    </script>
    
</body>
<br>
<br><br><br><br>

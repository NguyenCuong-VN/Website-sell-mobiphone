
<?php 
    session_start(); 
    //check login
    if(!isset($_SESSION['id_admin'])){
        header('Location: loginadmin.php');
    }
    //control change passwd
    elseif(isset($_POST['savepasswd'])){
        require_once("./Models/check.php");
        require_once("./Models/M_admin.php");
        $old_passwd = $_POST['old_passwd'];
        $old_passwd = strip_tags($old_passwd);
        $old_passwd = addslashes($old_passwd);
        $new_passwd = $_POST['new_passwd'];
        $new_passwd = strip_tags($new_passwd);
        $new_passwd = addslashes($new_passwd);
        $renew_passwd = $_POST['renew_passwd'];
        $renew_passwd = strip_tags($renew_passwd);
        $renew_passwd = addslashes($renew_passwd);
        if($new_passwd == '' || $renew_passwd == '' || $old_passwd == ''){
            echo "1";
            return;
        }
        elseif($new_passwd != $renew_passwd){
            echo "2";
            return;
        }
        else{
            $model_admin = new Model_admin();
            $edit = $model_admin->changePasswd($_SESSION['id_admin'], $old_passwd, $new_passwd);
            if($edit== 1){
                echo "3";
                return;
            }
            elseif($edit== 2){
                echo "4";
                return;
            }
            else{
                echo "5";
                return;
            }
        }
    }
    //control change infomation admin
    elseif(isset($_POST['save'])){
        require_once("./Models/check.php");
        require_once("./Models/M_admin.php");
        $name_adm = $_POST['name_adm'];
        $email_adm = $_POST['email_adm'];
        $phone_adm = $_POST['phone_adm'];


        $name_adm = strip_tags($name_adm);
        $name_adm = addslashes($name_adm);
        $email_adm = strip_tags($email_adm);
        $email_adm = addslashes($email_adm);
        $phone_adm = strip_tags($phone_adm);
        $phone_adm = addslashes($phone_adm);

        if($name_adm == "" || $email_adm == "" || $phone_adm == ""){
            echo "1";
            return;
        }
        elseif(!checkNum($phone_adm)){
            echo "2";
            return;
        }
        elseif(!checkEmail($email_adm)){
            echo "3";
            return;
        }
        else{
            $model_admin = new Model_admin();
            $edit = $model_admin->editAdmin($_SESSION['id_admin'], $name_adm, $email_adm, $phone_adm);
            if($edit== null) echo "4";
            else{
                $_SESSION['name_admin'] = $name_adm;
                $_SESSION['email_admin'] = $email_adm;
                $_SESSION['phone_admin'] = $phone_adm;
                echo "5";
            }
            return;
        }
    }
    //control render content
    elseif(isset($_GET['content'])){
        if($_GET['content'] == "thongtin"){
            require_once("./Models/M_position.php");
            require_once("./Models/position.php");
            $model_position = new Model_position();
            $position = $model_position->getPositionID($_SESSION['id_position_admin']);
            return require_once("./Views/admin/thongtin.php");
        }
        elseif($_GET['content'] == "donhang"){
            require_once("./Models/M_order.php");
            require_once("./Models/order.php");
            $model_order = new Model_order();
            $order = $model_order->getAllOrder();
            return require_once("./Views/admin/donhang.php");
        }
        elseif($_GET['content'] == "sanpham"){
            require_once("./Models/M_product.php");
            require_once("./Models/product.php");
            require_once("./Models/category.php");
            require_once("./Models/M_category.php");
            $model_product = new Model_product();
            $products = $model_product->getAllProductAndCategory();
            $model_category = new Model_category();
            $categorys = $model_category->getAllCategory(); 
            return require_once("./Views/admin/sanpham.php");
        }
        elseif($_GET['content'] == "nhanhieu"){
            require_once("./Models/M_product.php");
            require_once("./Models/category.php");
            require_once("./Models/M_category.php");
            $model_category = new Model_category();
            $categories = $model_category->getAllCategory();
            $model_product = new Model_product();
            $amountCate;
            foreach($categories as $row){
                $amountCate[$row->id] = count($model_product->getProductCategory($row->id));
            }
            return require_once("./Views/admin/nhanhieu.php");
        }
        elseif($_GET['content'] == "user"){
            require_once("./Models/M_position.php");
            $model_position = new Model_position();
            $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 4);
            if(!$check){
                echo '<div class="alert alert-danger">Bạn không đủ quyền thực hiện tác vụ này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                return;
            }
            else{
                require_once("./Models/M_admin.php");
                require_once("./Models/admin.php");
                $model_admin = new Model_admin();
                $admins = $model_admin->getAllAdminAndPosition();
                return require_once("./Views/admin/user.php");
            }
        }
        elseif($_GET['content'] == "chucdanh"){
            require_once("./Models/M_position.php");
            $model_position = new Model_position();
            $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 4);
            if(!$check){
                echo '<div class="alert alert-danger">Bạn không đủ quyền thực hiện tác vụ này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                return;
            }
            else{
                require_once("./Models/M_position.php");
                require_once("./Models/position.php");
                $model_position = new Model_position();
                $positions = $model_position->getAllPosition();
                return require_once("./Views/admin/chucdanh.php");
            }
        }
        elseif($_GET['content'] == "thongke"){
            require_once("./Models/M_position.php");
            $model_position = new Model_position();
            $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 4);
            if(!$check){
                echo '<div class="alert alert-danger">Bạn không đủ quyền thực hiện tác vụ này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                return;
            }
            else{
                require_once("./Models/M_order.php");
                require_once("./Models/order.php");
                $model_order = new Model_order();
                $dataAmountDates;
                $dataTotalDates;
                for($i = 1; $i <31; $i++){
                    $orders = $model_order->searchOrder($i, '5', '2020', '5', '');
                    $amount=0;
                    $total=0;
                    foreach($orders as $row){
                        $amount++;
                        $total+=(int)$row->total_price;
                    }
                    $dataAmountDates[$i]=$amount;
                    $dataTotalDates[$i]=$total;
                }
                
                $dataAmountMonths;
                $dataTotalMonths;
                for($i = 1; $i <13; $i++){
                    $orders = $model_order->searchOrder('%', $i, '2020', '5', '');
                    $amount=0;
                    $total=0;
                    foreach($orders as $row){
                        $amount++;
                        $total+=(int)$row->total_price;
                    }
                    $dataAmountMonths[$i]=$amount;
                    $dataTotalMonths[$i]=$total;
                }
                $random1="abc".mt_rand(0, 10000);
                $random2="abc".mt_rand(0, 10000);
                $random3="abc".mt_rand(0, 10000);
                $random4="abc".mt_rand(0, 10000);
                return require_once("./Views/admin/thongke.php");
            }
        }
    }
    //control render detail product
    elseif(isset($_GET['idproduct'])){
        require_once("./Models/M_product.php");
        require_once("./Models/product.php");
        require_once("./Models/category.php");
        require_once("./Models/M_category.php");
        $model_product = new Model_product();
        $product = $model_product->getProductID($_GET['idproduct']);
        $product=$product[0];
        $model_category = new Model_category();
        $category = $model_category->getCategoryID($product->category_id); 
        echo "<div class=\"alert alert-success\" id=\"sanpham\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" onclick=\"location='#$product->id'\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã sản phẩm:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"masanpham\">$product->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên sản phẩm:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"tensp\" type=\"text\" value=\"$product->name\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Nội dung:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <textarea class=\"form-control\" rows=\"7\" id=\"noidungsp\" disabled>$product->content</textarea>
                        <br>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Giá:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"giasp\" type=\"text\" value=\"$product->price\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Giảm giá:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"giamsp\" type=\"text\" value=\"$product->percent_sale\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Giá sau giảm:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"giagiamsp\" type=\"text\" value=\"$product->sale_price\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Thương hiệu:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"tenthuonghieu\" type=\"text\" value=\"$category->name\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Số lượng:</b></label>
                    </div>
                    <div class=\"col-4\">
                    <input class=\"form-control\" id=\"soluongsp\" type=\"text\" value=\"$product->amount\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tạo ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                    <input class=\"form-control\" id=\"ngaytaosp\" type=\"text\" value=\"$product->create_at\" disabled>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Cập nhật ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                    <input class=\"form-control\" id=\"ngaysuasp\" type=\"text\" value=\"$product->update_at\" disabled>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-1 offset-5\">
                        <button type=\"button\" class=\"btn btn-warning\" id=\"edit\" value=\"edit\" onclick=\"check(this.id)\">Sửa</button>
                    </div>
                </div>
            </div>";
        return;    
    }
    //control render detail category
    elseif(isset($_GET['idcate'])){
        require_once("./Models/M_product.php");
        require_once("./Models/category.php");
        require_once("./Models/M_category.php");
        $model_product = new Model_product();
        $model_category = new Model_category();
        $category = $model_category->getCategoryID($_GET['idcate']); 
        $mount = count($model_product->getProductCategory($_GET['idcate']));
        echo "<div class=\"alert alert-success\" id=\"sanpham\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" onclick=\"location='#$category->id'\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã thương hiệu:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"mathuonghieu\">$category->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên thương hiệu:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"tenthuonghieu\" type=\"text\" value=\"$category->name\" disabled>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mô tả:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <textarea class=\"form-control\" rows=\"4\" id=\"noidungthuonghieu\" disabled>$category->description</textarea>
                        <br>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Số lượng sản phẩm:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"soluongsanpham\">$mount</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tạo ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"ngaytaothuonghieu\">$category->create_at</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Cập nhật ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"ngaysuathuonghieu\">$category->update_at</label>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-1 offset-5\">
                        <button type=\"button\" class=\"btn btn-warning\" id=\"edit\" value=\"edit\" onclick=\"check(this.id)\">Sửa</button>
                    </div>
                </div>
            </div>";
        return;    
    }
    //control render detail position
    elseif(isset($_GET['idposition'])){
        require_once("./Models/M_position.php");
        require_once("./Models/position.php");
        $model_position = new Model_position();
        $position = $model_position->getPositionID($_GET['idposition']); 
        $permissions = $model_position->getPositionPermission($position->id);
        echo "<div class=\"alert alert-success\" id=\"sanpham\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã chức danh:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"machucdanh\">$position->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên chức danh:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"tenchucdanh\" type=\"text\" value=\"$position->name\" disabled>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mô tả:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <input class=\"form-control\" id=\"mota\" type=\"text\" value=\"$position->description\" disabled>
                        <br>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Quyền hạn:</b></label>
                    </div>
                    <div class=\"col-4\" id=\"quyenhan\">";
        foreach($permissions as $row){
            echo "<label for=\"ten\">$row</label><br>";
        }
        echo "      </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-1 offset-5\">
                        <button type=\"button\" class=\"btn btn-warning\" id=\"edit\" value=\"edit\" onclick=\"check(this.id)\">Sửa</button>
                    </div>
                </div>
            </div>";
        return;    
    }
    //control render detail user 
    elseif(isset($_GET['iduser'])){
        require_once("./Models/admin.php");
        require_once("./Models/M_admin.php");
        $model_admin = new Model_admin();
        $admin = $model_admin->getAllAdminIDAndPosition($_GET['iduser']); 
        echo "<div class=\"alert alert-success\" id=\"sanpham\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã nhân viên:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"manhanvien\">$admin->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên nhân viên:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"tennhanvien\">$admin->full_name</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Email:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"email\">$admin->email</label>
                        <br>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Số điện thoại:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"sodienthoai\">$admin->phone</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tạo ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"ngaytaouser\">$admin->create_at</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Cập nhật ngày:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"ngaysuauser\">$admin->update_at</label>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Chức vụ:</b></label>
                    </div>
                    <div class=\"col-4\" id=\"changeposition\">
                        <label for=\"ten\" id=\"chucvuuser\">$admin->id_position</label>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>ID nhân viên:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\" id=\"idnhanvien\">$admin->ID_employee_number</label>
                    </div>
                </div>
                <br>
                <div class=\"row\">
                    <div class=\"col-1 offset-5\">
                        <button type=\"button\" class=\"btn btn-warning\" id=\"edit\" value=\"edit\" onclick=\"check(this.id)\">Sửa</button>
                    </div>
                </div>
            </div>";
        return;    
    }
    //control change product infomation
    elseif(isset($_POST['saveproduct'])){
        require_once("./Models/M_position.php");
        require_once("./Models/M_product.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 2);
        if($check){
            $masanpham = $_POST['masanpham'];
            $tensp = $_POST['tensp'];
            $noidungsp = $_POST['noidungsp'];
            $giasp = $_POST['giasp'];
            $giamsp = $_POST['giamsp'];
            $giagiamsp = $_POST['giagiamsp'];
            $soluongsp = $_POST['soluongsp'];

            $masanpham = strip_tags($masanpham);
            $masanpham = addslashes($masanpham);
            $tensp = strip_tags($tensp);
            $tensp = addslashes($tensp);
            $noidungsp = strip_tags($noidungsp);
            $noidungsp = addslashes($noidungsp);
            $giasp = strip_tags($giasp);
            $giasp = addslashes($giasp);
            $giamsp = strip_tags($giamsp);
            $giamsp = addslashes($giamsp);
            $giagiamsp = strip_tags($giagiamsp);
            $giagiamsp = addslashes($giagiamsp);
            $soluongsp = strip_tags($soluongsp);
            $soluongsp = addslashes($soluongsp);

            if($tensp == "" || $noidungsp == "" || $giasp == "" || $giamsp == "" || $giagiamsp == "" || $soluongsp == ""){
                echo "2";
                return;
            }
            elseif(!checkNum($soluongsp)){
                echo "3";
                return;
            }
            else{
                $model_product = new Model_product();
                $edit = $model_product->editProduct($masanpham, $tensp, $noidungsp, $giasp, $giamsp, $giagiamsp, $soluongsp);
                if($edit== null) echo "4";
                else{
                    echo "5";
                }
                return;
            }
        }
        else {
            echo "1";
            return;
        }
    }
    //control change position infomation
    elseif(isset($_POST['savePermissionPosition'])){
        require_once("./Models/check.php");
        require_once("./Models/M_position.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 5);
        if($check){
            $machucdanh = $_POST['machucdanh'];
            $tenchucdanh = $_POST['tenchucdanh'];
            $mota = $_POST['mota'];
            $quyenhan = $_POST['quyenhan'];

            $machucdanh = strip_tags($machucdanh);
            $machucdanh = addslashes($machucdanh);
            $tenchucdanh = strip_tags($tenchucdanh);
            $tenchucdanh = addslashes($tenchucdanh);
            $mota = strip_tags($mota);
            $mota = addslashes($mota);

            if($machucdanh == "" || $tenchucdanh == "" || $mota == ""){
                echo "2";
                return;
            }
            elseif(!checkNum($machucdanh)){
                echo "3";
                return;
            }
            else{
                $edit = $model_position->setPermissionPosition($machucdanh, $tenchucdanh, $mota, $quyenhan);
                if($edit== null) echo "4";
                else{
                    echo "5";
                }
                return;
            }
        }
        else {
            echo "1";
            return;
        }
    }
    //control change user infomation
    elseif(isset($_POST['saveuser'])){
        require_once("./Models/check.php");
        require_once("./Models/M_position.php");
        require_once("./Models/M_admin.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 4);
        if($check){
            $manhanvien = $_POST['manhanvien'];
            $chucvuuser = $_POST['chucvuuser'];

            $manhanvien = strip_tags($manhanvien);
            $manhanvien = addslashes($manhanvien);
            $chucvuuser = strip_tags($chucvuuser);
            $chucvuuser = addslashes($chucvuuser);
            if($manhanvien == "" || $chucvuuser == ""){
                echo "2";
                return;
            }
            elseif(!checkNum($manhanvien) || !checkNum($chucvuuser)){
                echo "3";
                return;
            }
            else{
                $model_admin = new Model_admin();
                $edit = $model_admin->editPosition($manhanvien, $chucvuuser);
                if($edit== null) echo "4";
                else{
                    echo "5";
                }
                return;
            }
        }
        else {
            echo "1";
            return;
        }
    }
    //control render product search
    elseif(isset($_GET['searchProduct'])){
        require_once("./Models/M_product.php");
        require_once("./Models/product.php");
        require_once("./Models/check.php");

        $thuonghieuproduct = $_GET['thuonghieuproduct'];
        $name = $_GET['name'];
        $thuonghieuproduct = strip_tags($thuonghieuproduct);
        $thuonghieuproduct = addslashes($thuonghieuproduct);
        $name = strip_tags($name);
        $name = addslashes($name);
            $model_product = new Model_product();
            $products = $model_product->searchProductAndCategory($name, $thuonghieuproduct);
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
            return;
    }
    //control render user search
    elseif(isset($_GET['searchUser'])){
        require_once("./Models/M_admin.php");
        require_once("./Models/admin.php");

        $name = $_GET['name'];
        $name = strip_tags($name);
        $name = addslashes($name);

        $model_admin = new Model_admin();
        $admins = $model_admin->searchAllAdminAndPosition($name);
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
        return;    
    }
    //control render position search
    elseif(isset($_GET['searchPosition'])){
        require_once("./Models/M_position.php");
        require_once("./Models/position.php");

        $name = $_GET['name'];
        $name = strip_tags($name);
        $name = addslashes($name);
            $model_position = new Model_position();
            $positions = $model_position->searchPosition($name);
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
            return;
    }
    //control render search category
    elseif(isset($_GET['searchCategory'])){
        require_once("./Models/M_product.php");
        require_once("./Models/M_category.php");

        $name = $_GET['name'];
        $name = strip_tags($name);
        $name = addslashes($name);
            $model_category = new Model_category();
            $categories = $model_category->searchCategory($name);
            
            $model_product = new Model_product();
            $amountCate;
            foreach($categories as $row){
                $amountCate[$row->id] = count($model_product->getProductCategory($row->id));
            }
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
            return;
    }
    //control create user
    elseif(isset($_POST['new_user'])){
        require_once("./Models/M_position.php");
        require_once("./Models/check.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 4);
        if(!$check){
            echo '1';
            return;
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $chucvu = $_POST['chucvu'];
        $IDnhanvien = $_POST['IDnhanvien'];

        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        $repassword = strip_tags($repassword);
        $repassword = addslashes($repassword);
        $fullname = strip_tags($fullname);
        $fullname = addslashes($fullname);
        $email = strip_tags($email);
        $email = addslashes($email);
        $phone = strip_tags($phone);
        $phone = addslashes($phone);
        $chucvu = strip_tags($chucvu);
        $chucvu = addslashes($chucvu);
        $IDnhanvien = strip_tags($IDnhanvien);
        $IDnhanvien = addslashes($IDnhanvien);
        
        

        if($username == '' || $password == '' || $repassword == '' || $fullname == '' || $email == '' || $chucvu == '' || $IDnhanvien == ''){
            echo '2';
            return;
        }
        elseif(!checkNum($phone) && $phone != ""){
            echo '3';
            return;
        }
        elseif(!checkNum($chucvu)){
            echo '4';
            return;
        }
        elseif(!checkEmail($email)){
            echo '8';
            return;
        }
        elseif($password != $repassword){
            echo "5";
            return;
        }
        else{
            require_once("./Models/M_admin.php");
            require_once("./Models/admin.php");
            $model_admin = new Model_admin();
            $create = $model_admin->createAdmin($username, $password, $fullname, $phone, $email, $chucvu, $IDnhanvien);
            if(!$create){
                echo '6';
            }
            else echo '7';
            return;
        }
    }
    //control create category
    elseif(isset($_POST['new_category'])){
        require_once("./Models/M_position.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 3);
        if(!$check){
            echo '1';
            return;
        }
        $new_thuonghieu = $_POST['new_thuonghieu'];
        $new_noidungthuonghieu = $_POST['new_noidungthuonghieu'];
        $new_thuonghieu = strip_tags($new_thuonghieu);
        $new_thuonghieu = addslashes($new_thuonghieu);
        $new_noidungthuonghieu = strip_tags($new_noidungthuonghieu);
        $new_noidungthuonghieu = addslashes($new_noidungthuonghieu);

        if($new_thuonghieu == '' || $new_noidungthuonghieu == ''){
            echo '2';
            return;
        }
        else{
            require_once("./Models/M_category.php");
            $model_category = new Model_category();
            $create = $model_category->createCategory($new_thuonghieu, $new_noidungthuonghieu);
            echo "4";
            return;
        }
    }
    //control create position
    elseif(isset($_POST['new_Position'])){
        require_once("./Models/M_position.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 5);
        if(!$check){
            echo '1';
            return;
        }
            $tenchucdanh = $_POST['tenchucdanh'];
            $motachucdanh = $_POST['motachucdanh'];
            $quyenhan = $_POST['quyenhan'];

            $tenchucdanh = strip_tags($tenchucdanh);
            $tenchucdanh = addslashes($tenchucdanh);
            $motachucdanh = strip_tags($motachucdanh);
            $motachucdanh = addslashes($motachucdanh);

            if($tenchucdanh == "" || $motachucdanh == ""){
                echo "2";
                return;
            }
            else{
                $create = $model_position->createPosition($tenchucdanh, $motachucdanh, $quyenhan);
                if($create == null) echo "4";
                else{
                    echo "5";
                }
                return;
            }
    }
    //control create product
    elseif(isset($_POST['new_button'])){
        require_once("./Models/M_position.php");
        require_once("./Models/M_product.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 2);
        if(!$check){
            echo '<div class="alert alert-danger">Bạn không đủ quyền thực hiện tác vụ này!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
            return;
        }
        require_once("./Models/check.php");
        $name = $_POST['new_ten'];
        $noidung = $_POST['new_noidung'];
        $gia = $_POST['new_gia'];
        $giamgia = $_POST['new_giamgia'];
        $giasaugiam = $_POST['new_giasaugiam'];
        $soluong = $_POST['new_soluong'];
        $thuonghieu = $_POST['new_thuonghieu'];

        $name = strip_tags($name);
        $name = addslashes($name);
        $noidung = strip_tags($noidung);
        $noidung = addslashes($noidung);
        $gia = strip_tags($gia);
        $gia = addslashes($gia);
        $giamgia = strip_tags($giamgia);
        $giamgia = addslashes($giamgia);
        $giasaugiam = strip_tags($giasaugiam);
        $giasaugiam = addslashes($giasaugiam);
        $soluong = strip_tags($soluong);
        $soluong = addslashes($soluong);
        $thuonghieu = strip_tags($thuonghieu);
        $thuonghieu = addslashes($thuonghieu);

        if($name == '' || $noidung == '' || $gia == '' || $giamgia == '' || $giasaugiam == '' || $soluong == '' || $thuonghieu == ''){
            echo '<div class="alert alert-danger">Thiếu các trường bắt buộc!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
        }
        elseif(!checkNum($soluong)){
            echo '<div class="alert alert-danger">Trường số lượng phải là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
        }
        else{
            $files = $_FILES['fileupload'];
            $names      = $files['name'];
            $types      = $files['type'];
            $tmp_names  = $files['tmp_name'];
            $errors     = $files['error'];
            $sizes      = $files['size'];
            $numitems = count($names);
            for ($i = 0; $i < $numitems; $i++) {
                if ($errors[$i] == 0)
                {
                    $check = getimagesize($tmp_names[$i]);
                    if($check == false) {
                        echo '<div class="alert alert-danger">Đây không phải file ảnh!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                        break;
                    }
                    if (file_exists("uploads/$names[$i]")) {
                        continue;
                    }
                    if (move_uploaded_file($tmp_names[$i], "uploads/$names[$i]"))
                        {
                            if($i+1 == $numitems){
                                $model_product = new Model_product();
                                $product = $model_product->createProduct($name, "uploads/$names[$i]", $noidung, $gia, $giamgia, $giasaugiam, $thuonghieu, $soluong);
                                for($j = 0; $j < $numitems; $j++){
                                    $model_product->setImageProduct($names[$j], $product->id, "uploads/$names[$j]");
                                }
                                echo '<div class="alert alert-success">Sản phẩm mới đã được tạo thành công!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                            } 
                        }
                    else
                        {
                            echo '<div class="alert alert-danger">Có lỗi xảy ra khi upload file!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
                            break;
                        }
                }
            }
        }
    }
    //control render all position
    elseif(isset($_GET['allposition'])){
        require_once("./Models/M_position.php");
        require_once("./Models/position.php");
        $model_position = new Model_position();
        $positions = $model_position->getAllPosition();
        echo "<select class=\"form-control\" id=\"selectposition\">";
        foreach($positions as $row){
            echo "<option value=\"$row->id\">$row->name</option>";
        }
        echo "</select>";
        return;
    }
    //control render all permission
    elseif(isset($_GET['allPermission'])){
        require_once("./Models/M_position.php");
        require_once("./Models/position.php");
        $model_position = new Model_position();
        $positions = $model_position->getAllPermission();
        foreach($positions as $key=>$value){
            echo "<input type=\"checkbox\" name=\"permiss\" value=\"$key\"/> <label>$value</label> <br/>";
        }
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control</title>
    <link rel="stylesheet" href="http://localhost/dienthoaididong/bootstrap/css/bootstrap.min.css">
    <script src="http://localhost/dienthoaididong/bootstrap/jquery-3.5.0.min.js"></script>
    <script src="http://localhost/dienthoaididong/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
</head>
<body>
    <br>
    <!-- load info site -->
    <center>
        <a href="http://localhost/dienthoaididong/index.php"><img src="http://localhost/dienthoaididong/image/logo.jpg" class="img.embed-responsive" alt="logo" width="280" height="110"></a>
        <br><br>
        <h2 class="text-center"><strong style="color:green">TRANG QUẢN LÝ CỦA ADMIN</strong></h2>
        <p><center>-----------------------------------------------------------------</center></p>
        <h7 class="text-center"><strong style="color:brown">User hiện tại: <?=$_SESSION['name_admin']?></strong></h7>
        <br><br>
    <!-- load content control button -->
        <button type="button" class="btn btn-info" id="thongtin" onclick="load(this.id)">Thông tin</button>
        <span> | </span>
        <button type="button" class="btn btn-success" id="donhang" onclick="load(this.id)">Đơn hàng</button>
        <span> | </span>
        <button type="button" class="btn btn-primary" id="sanpham" onclick="load(this.id)">Sản phẩm</button>
        <span> | </span>
        <button type="button" class="btn btn-secondary" id="nhanhieu" onclick="load(this.id)">Nhãn hiệu</button>
        <span> | </span>
        <button type="button" class="btn btn-danger" id="user"" onclick="load(this.id)">User</button>
        <span> | </span>
        <button type="button" class="btn btn-dark" id="chucdanh" onclick="load(this.id)">Chức danh</button>
        <span> | </span>
        <button type="button" class="btn btn-warning" id="thongke" onclick="load(this.id)">Thống kê</button>
        <span> | </span>
        <a href="http://localhost/dienthoaididong/loginadmin.php" type="button" class="btn btn-outline-dark" >Đăng xuất</a>
    </center>
    <!-- content control base -->
    <div class="container-fluid" id="content">

    </div>
</body>
<!-- ajax load content -->
<script>
    function load(conte){
        $.ajax({
            url: 'http://localhost/dienthoaididong/manageradmin.php',
            type: 'GET',
            dataType: 'html',
            data:{
                content: conte
            }
        }).done(function(ketqua){
            $('#content').html(ketqua);
        });
    }
</script>
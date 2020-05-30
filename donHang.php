<?php 
    session_start();
    //control render detail order from customer site
    if(isset($_GET['idOder'])){
        require_once("./Models/M_order.php");
        $model_order = new Model_order();
        $order = $model_order->getOrderID($_GET['idOder']);
        $products = $model_order->getProductOrder($order->id);
        $name_custmer=$_SESSION['name_customer'];
        echo "<div class=\"alert alert-success\" id=\"donhang\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" onclick=\"location='#$order->id'\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã đơn hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên khách hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$name_custmer</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Trạng thái:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_status_order</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Địa chỉ giao hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->address_ship</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Số điện thoại:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->phone_number</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Phương thức giao hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_deliver_method</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Phương thức thanh toán:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_payment_method</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Thông tin thanh toán (nếu có):</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->info_payment</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Thời gian mua:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->create_at</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tổng giá trị:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->total_price đ</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Sản phẩm:</b></label>
                    </div>
                    <div class=\"col-4\">";
                    foreach ($products as $row) {
                        echo "<label for=\"ten\">$row->name</label><br>";
                    }

        echo "          </div>
                    </div>";
        echo "</div>";
        return;    
    }
    //control render detail order from admin site
    elseif(isset($_GET['idOderAdmin'])){
        require_once("./Models/M_order.php");
        require_once("./Models/M_customer.php");
        $model_order = new Model_order();
        $order = $model_order->getOrderID($_GET['idOderAdmin']);
        $products = $model_order->getProductOrder($order->id);
        $model_custmer= new Model_customer();
        $name_custmer= $model_custmer->getCustomerID($order->id_customer);
        $name_custmer=$name_custmer->full_name;
        echo "<div class=\"alert alert-success\" id=\"donhang\">";
        echo "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" onclick=\"location='#$order->id'\">x</button>
                <br>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Mã đơn hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tên khách hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$name_custmer</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Trạng thái:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_status_order</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Địa chỉ giao hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->address_ship</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Số điện thoại:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->phone_number</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Phương thức giao hàng:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_deliver_method</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Phương thức thanh toán:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->id_payment_method</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Thông tin thanh toán (nếu có):</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->info_payment</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Thời gian mua:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->create_at</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Tổng giá trị:</b></label>
                    </div>
                    <div class=\"col-4\">
                        <label for=\"ten\">$order->total_price đ</label>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-3 offset-2\">
                        <label for=\"ten\"><b>Sản phẩm:</b></label>
                    </div>
                    <div class=\"col-4\">";
                        // <label for=\"ten\">$order->create_at</label>"
                    foreach ($products as $row) {
                        echo "<label for=\"ten\">$row->name</label><br>";
                    }
        echo "          </div>
                    </div>";
        echo "</div>";
        return;    
    }
    //control change status order
    elseif (isset($_GET['idStatus'])) {
        require_once("./Models/M_order.php");
        require_once("./Models/M_position.php");
        $model_position = new Model_position();
        $check = $model_position->checkPositionPermission($_SESSION['id_position_admin'], 1);
        if($check){
            $model_order = new Model_order();
            $edit = $model_order->updateStatus($_GET['idStatus'], $_GET['idOrder']);
            if($edit) echo "1";
            else echo "2";
            return;
        }
        else {
            echo "3";
            return;
        }
        
    }
    //control render search order
    elseif(isset($_GET['searchOrder'])){
        require_once("./Models/M_order.php");
        require_once("./Models/order.php");
        require_once("./Models/check.php");
        
        $date = $_GET['date'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $status = $_GET['status'];
        $ID = $_GET['ID'];

        $date = strip_tags($date);
        $date = addslashes($date);
        $month = strip_tags($month);
        $month = addslashes($month);
        $year = strip_tags($year);
        $year = addslashes($year);
        $status = strip_tags($status);
        $status = addslashes($status);
        $ID = strip_tags($ID);
        $ID = addslashes($ID);

        if(!checkNum($ID)){
            echo '<div class="alert alert-danger">Thanh search chỉ được nhập ID là số!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>';
            return;
        }
        else{
            $model_order = new Model_order();
            $order = $model_order->searchOrder($date, $month, $year, $status, $ID);
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
            return;
        }

        
    }
?>
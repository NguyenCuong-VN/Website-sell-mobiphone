<div id="alert"></div>
<br><br>
<!-- form info order  -->
<div class="container-fluid">
    <h1 class="text-center" id="tieu_de">Thông tin liên lạc</h1>
    <br />
    <form method="POST" action="http://localhost/dienthoaididong/thanhtoan.php" id="form_thong_tin">
        <fieldset>
            <label>Tên khách hàng:<span style="color:red">*</span></label><br />
            <input class="form-control" value="<?php echo $_SESSION['name_customer'] ?>" id="order_name" type="text" />

            <label>Địa chỉ nhận hàng:<span style="color:red">*</span></label><br />
            <input class="form-control" value="<?php echo $_SESSION['address_customer'] ?>" id="order_address" type="text" />

            <label>Số điện thoại:<span style="color:red">*</span></label><br />
            <input class="form-control" value="<?php echo $_SESSION['phone_customer'] ?>" id="order_phone" type="text" />
            
            <label>Phương thức vận chuyển:<span style="color:red">*</span></label><br />
            <select class="form-control" id="order_deliver">
            <?php 
                foreach($deliver_methods as $row){
                    echo "<option>$row->name</option>";
                }
            ?>
            </select>

            <label>Phương thức thanh toán:<span style="color:red">*</span></label><br />
            <select class="form-control" id="order_payment" id="payment_method" onchange="check(this.id)">
            <?php 
                foreach($payment_methods as $row){
                    echo "<option>$row->name</option>";
                }
            ?>
            </select>
            
            <div id="bank_info">
                
            </div>
            
            <br />
            <button class="btn btn-info" type="button" id="btn_xacnhan" onclick="subm()">Xác nhận</button>
        </fieldset>
    </form>
</div>

<br><br><br><br><br>

<script>
    //get data bank infomation of user
    function check(id) { 
        let method=$('#'+id).val();
        if(method == "Ngân hàng"){
            $('#bank_info').html("<label>Số tài khoản:<span style=\"color:red\">*</span></label><br /><input class=\"form-control\" value=\"<?php echo $_SESSION['bank_customer'] ?>\" id=\"order_bank\" type=\"text\" />");
        }
        else $('#bank_info').html('');
    }
    //check data
    function subm() {
        $.ajax({
            url: 'http://localhost/dienthoaididong/thanhtoan.php',
            type: 'POST',
            dataType: 'html',
            data:{
                order_name: $('#order_name').val(),
                order_address: $('#order_address').val(),
                order_phone: $('#order_phone').val(),
                order_deliver: $('#order_deliver').val(),
                order_payment: $('#order_payment').val(),
                btn_xacnhan: 'xacnhan',
                order_bank: $('#order_bank').val(),
            }
        }).done(function(ketqua){
            if(ketqua == 1){
                $('#alert').html('<div class="alert alert-danger">Số tài khoản phải là chữ số !<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            }
            else if(ketqua == 2){
                $('#alert').html('<div class="alert alert-danger">Vui lòng nhập hết các ô có dấu * !<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            }
            else if(ketqua == 3){
                $('#alert').html('<div class="alert alert-danger">Số điện thoại không đúng định dạng, vui lòng nhập lại!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            }
            else if(ketqua == 4){
                $('#alert').html('<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại sau!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            }
            else if(ketqua == 5){
                $('#alert').html('<div class="alert alert-success">Đơn hàng của bạn đã được đưa vào hàng chờ xử lý. Cảm ơn đã sử dụng dịch vụ của chúng tôi!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                $('#bar').attr('style', 'width:100%');
                $('#bar').text('100%');
            }
        });
    }
    
</script>
<?php 
    class Order{
        public $id;
        public $id_customer;
        public $id_status_order;
        public $address_ship;
        public $phone_number;
        public $id_deliver_method;
        public $id_payment_method;
        public $info_payment;
        public $create_at;
        public $update_at;
        public $total_price;

        public function __construct($_id, $_id_customer, $_id_status_order, $_address_ship, $_phone_number, $_id_deliver_method,  $_id_payment_method, $_info_payment, $_create_at, $_update_at, $_total_price){
            $this->id = $_id;
            $this->id_customer = $_id_customer;
            $this->id_status_order = $_id_status_order;
            $this->address_ship = $_address_ship;
            $this->phone_number = $_phone_number;
            $this->id_deliver_method = $_id_deliver_method;
            $this->id_payment_method = $_id_payment_method;
            $this->info_payment = $_info_payment;
            $this->create_at = $_create_at;
            $this->update_at = $_update_at;
            $this->total_price = $_total_price;
        }
    }
?>
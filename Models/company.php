<?php 
    class company{
        public $name;
        public $email;
        public $phone;
        public $address;

        public function __construct($_name, $_email, $_phone, $_address)
        {
            $this->name=$_name;
            $this->email=$_email;
            $this->phone=$_phone;
            $this->address=$_address;
        }
    }
?>
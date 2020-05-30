<?php 
    class Product{
        public $id;
        public $name;
        public $image_thumbnail;
        public $content;
        public $price;
        public $percent_sale;
        public $sale_price;
        public $category_id;
        public $amount;
        public $create_at;
        public $update_at;

        public function __construct($_id, $_name, $_image_thumbnail, $_content, $_price, $_percent_sale, $_sale_price, $_category_id, $_amount, $_create_at, $_update_at){
            $this->id = $_id;
            $this->name = $_name;
            $this->image_thumbnail = $_image_thumbnail;
            $this->content = $_content;
            $this->price = $_price;
            $this->percent_sale = $_percent_sale;
            $this->sale_price = $_sale_price;
            $this->category_id = $_category_id;
            $this->amount = $_amount;
            $this->create_at = $_create_at;
            $this->update_at = $_update_at;
        }
    }
?>
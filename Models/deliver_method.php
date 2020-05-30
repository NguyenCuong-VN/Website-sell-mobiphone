<?php 
    class Deliver_method{
        public $id;
        public $name;
        public $create_at;
        public $update_at;
        
        public function __construct($_id, $_name, $_create_at, $_update_at){
            $this->id = $_id;
            $this->name = $_name;
            $this->create_at = $_create_at;
            $this->update_at = $_update_at;
        }
    }
?>
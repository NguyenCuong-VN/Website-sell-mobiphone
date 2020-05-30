<?php 
    class Position{
        public $id;
        public $name;
        public $description;
        public $status;
        
        public function __construct($_id, $_name, $_description, $_status){
            $this->id = $_id;
            $this->name = $_name;
            $this->description = $_description;
            $this->status = $_status;
        }
    }
?>

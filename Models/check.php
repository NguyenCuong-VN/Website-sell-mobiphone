<?php 
    function checkNum($num){
            if(preg_match('/^[0-9]*$/', $num)){
                return true;
            }
        return false;
    }

    function checkString($string){
        if(preg_match('/^[\w\s]*$/', $string)){
            return true;
        }
    return false;
    }
    
    function checkEmail($email) { 
        if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email)) 
            return true; 
        else return false;
    } 
?>
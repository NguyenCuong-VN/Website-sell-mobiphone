<?php 
    session_start();
    //delete all session 
    session_destroy();
    header('Location: index.php');
?>
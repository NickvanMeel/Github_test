<?php
    session_start();
    include 'database/connection.php';
    include 'functions/general.php';
    if(isset($_SESSION['id'])){        
        $id = $_SESSION['id']; 
        $user_data = user_data($id, username, type);
    }
?>

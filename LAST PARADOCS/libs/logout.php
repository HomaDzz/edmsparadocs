<?php 
require ('installed.php');
unset($_SESSION['logged_user']);
unset($_SESSION['logged_user_group']);
header("Location: /");
?>
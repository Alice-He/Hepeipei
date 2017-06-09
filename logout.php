<?php
include_once './inc/config.inc.php';
if(isset($_SESSION['loginStatus'])){
    $_SESSION['loginStatus']  = 0;
    unset($_SESSION['loginStatus']);
    header("Location:index.php");
}else{
    header("Location:index.php");
}
?>
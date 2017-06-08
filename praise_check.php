<?php
error_reporting(E_ALL^E_NOTICE);
include_once './inc/config.inc.php';
include_once '/inc/mysql.inc.php';
$link=connect();
$post_id=$_GET['q'];
$query="select * from content where id = {$post_id}";
$result=execute($link,$query);
$A=mysqli_fetch_assoc($result);
if(!isset($_SESSION['zan'])||!$_SESSION['zan']) {
    $_SESSION['zan']=1;
    $A['zan']++;
}else{
    $_SESSION['zan']=0;
    $A['zan']--;
}
$query="update content set zan={$A['zan']} where id = {$post_id}";
$S=execute($link,$query);
header("Location:index.php");
?>
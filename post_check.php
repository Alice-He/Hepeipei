<?php
error_reporting(E_ALL^E_NOTICE);
include_once './inc/config.inc.php';
include_once './inc/mysql.inc.php';
$link=connect();
//$_POST['content'],$_POST['tag'],$_POST['anonymous'],$_SESSION['mid']
if(empty($_POST['content'])){
    echo"<script>alert ('内容不得为空！');
                 location.href='post.php';
               </script>";
}
if(mb_strlen($_POST['content'])>500){
    echo"<script>alert ('内容不得大于500个字符！');
                 location.href='post.php';
               </script>";
}
if(isset($_POST['submit'])){
    $_POST=escape($link,$_POST);
    if(!empty($_POST['anonymous'])) {
        $query = "insert into content(user_id,content,tag,time) values('0','{$_POST['content']}','{$_POST['tag']}',now())";
    }else{
        $query = "insert into content(user_id,content,tag,time) values('{$_SESSION['mid']}','{$_POST['content']}','{$_POST['tag']}',now())";
    }
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        echo"<script>alert ('Hello！{$_SESSION['name']}!');
                 location.href='index.php';
               </script>";
    }else{
        echo"<script>alert ('发布失败！请重试!');
                 location.href='post.php';
               </script>";
    }
}

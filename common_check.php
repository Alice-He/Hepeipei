<?php
include_once './inc/config.inc.php';
include_once './inc/mysql.inc.php';
$link=connect();
$cid=$_GET['cid'];
$query="select * from content where id = {$cid}";
$A=execute($link,$query);
if(!mysqli_num_rows($A)){
    echo"<script>alert ('留言id不存在！');
                 location.href='index.php';
               </script>";
}
if(empty($_POST['content'])){
    echo"<script>alert ('内容不得为空！');
                 location.href='comment.php?id={$cid}';
               </script>";
}
if(mb_strlen($_POST['content'])>300){
    echo"<script>alert ('内容不得大于300个字符！');
                 location.href='comment.php?id={$cid}';
               </script>";
}
if(isset($_POST['submit'])) {
    $_POST = escape($link, $_POST);
    if (!empty($_POST['anonymous'])) {
        $query = "insert into reply(content_id,user_id,reply,time) values('{$cid}','0','{$_POST['content']}',now())";
    } else {
        $query = "insert into reply(content_id,user_id,reply,time) values('{$cid}','{$_SESSION['mid']}','{$_POST['content']}',now())";
    }
    execute($link, $query);
    if (mysqli_affected_rows($link) == 1) {
        $a=mysqli_fetch_assoc($A);
        $a['comment']++;
        $query="update content set comment={$a['comment']} where id = {$cid}";

        execute($link,$query);
        echo"<script>alert ('留言成功！');
                 location.href='comment.php?id={$cid}';
               </script>";
    } else {
        echo"<script>alert ('留言失败！');
                 location.href='comment.php?id={$cid}';
               </script>";
    }
}

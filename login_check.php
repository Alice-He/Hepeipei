<?php
include_once './inc/config.inc.php';
include_once './inc/mysql.inc.php';
$link=connect();
if(isset($_POST['login'])){
    escape($link,$_POST);
    $query="select * from user_m where name='{$_POST['name']}'";
    $result=execute($link, $query);
    if(empty($_POST['name'])){
        echo"<script>alert ('用户名为空！');
                 location.href='login.php';
               </script>";
    }
    else if(empty($_POST['pw'])){
        echo"<script>alert ('密码为空！');
                 location.href='login.php';
               </script>";
    }
    else if(!mysqli_num_rows($result)){
        echo"<script>alert ('您尚未注册！');
                 location.href='login.php';
               </script>";
    }
    else{
        $query="select * from user_m where name='{$_POST['name']}'and password=md5('{$_POST['pw']}')";
        $result=execute($link, $query);
        if(mysqli_num_rows($result)==1){

            $_SESSION['loginStatus'] = 1;
            $_SESSION['name'] 	     = $_POST['name'];
            $query="select * from user_m where name={$_POST['name']}";
            $result=execute($link,$query);
            $res=mysqli_fetch_assoc($result);
            $_SESSION['mid']=$res['id'];
            echo"<script>alert ('欢迎您！ {$_SESSION['name']} ！');
                 location.href='index.php';
               </script>";
        }else{
            echo"<script>alert ('登录失败！');
                 location.href='login.php';
               </script>";
        }
    }
}
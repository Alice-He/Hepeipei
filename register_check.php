<?php
include_once './inc/mysql.inc.php';
include_once './inc/config.inc.php';
$link=connect();
if(isset($_POST['register'])){
    $_POST=escape($link,$_POST);
    $query="select * from user_m where name ='{$_POST['name']}'";
    $results=execute($link, $query);
    if(empty($_POST['name'])){
        echo"<script>alert ('用户名不得为空！');
                 location.href='register.php';
               </script>";
    }
    else if(mb_strlen($_POST['name'])>32){
        echo"<script>alert ('用户名不得大于32个字符！');
                 location.href='register.php';
               </script>";
    }
    else if(mb_strlen($_POST['pw'])<6){
        echo"<script>alert ('密码不得少于6个字符！');
                 location.href='register.php';
               </script>";
    }
    else if($_POST['pw']!=$_POST['repw']){
        echo"<script>alert ('两次输入密码不一致！');
                 location.href='register.php';
               </script>";
    }
    else if(mysqli_num_rows($results)){
        echo"<script>alert ('用户名已存在！');
                 location.href='register.php';
               </script>";
    }
    else{
        $_POST=escape($link,$_POST);
        $query="insert into user_m(name,password,register_time) values('{$_POST['name']}',md5('{$_POST['pw']}'),now())";
        execute($link,$query);
        if(mysqli_affected_rows($link)==1){
            header("Location:index.php");
            $_SESSION['loginStatus'] = 1;
            $_SESSION['name'] 	     = $_POST['name'];
            $_SESSION['password'] 	 = $_POST['password'];
            $query="select * from user_m where name={$_POST['name']}";
            $result=execute($link,$query);
            $res=mysqli_fetch_assoc($result);
            $_SESSION['mid']=$res['id'];
            echo"<script>alert ('注册成功！');
                 location.href='register.php';
               </script>";
        }
        else{
            echo"<script>alert ('注册失败！请重试！');
                 location.href='register.php';
               </script>";
        }
    }
}
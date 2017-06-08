<?php
error_reporting(E_ALL^E_NOTICE);
$error= isset($_GET['error']) ? $_GET['error'] : "";
echo "<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"utf-8\" >
<title>树洞 - 说出你心底的秘密 </title>	
<link href=\"./CSS/register.css\" rel=\"stylesheet\" type=\"text/css\">
</head>
<body>
<div class=\"sign\">
    <div class=\"logo\"><a href=\"#\" class=\"title\">欢迎登录</a></div>
    <div class=\"block\">
            <form class=\"form\" action=\"login_check.php\" method=\"POST\">
            <label class=\"form_name\" >Name：<br>
            <input id=\"uname\" type=\"text\" name=\"name\"></label><br>
		    <label class=\"form_pw\" >Password:<br>
            <input id=\"password\" class=\"input_pw\" type=\"password\" name=\"pw\"></label><br>
            <input class=\"btn1\" type=\"submit\" name=\"login\" value=\"Login\">
	    </form>
	       
	    <div class=\"note\">
		    <a href=\"index.php\">返回首页</a> | 
		    <a href=\"register.php\">没有帐号？去注册一个！</a>
	    </div>
    </div>
";
echo'</div>
</body>
</html>';


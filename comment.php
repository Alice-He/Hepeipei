<?php
error_reporting(E_ALL^E_NOTICE);
include_once './inc/mysql.inc.php';
include_once './inc/config.inc.php';
include_once './inc/page.inc.php';
$link=connect();
$cid=$_GET['id'];
$query="select * from content where id={$cid}";
$result=execute($link,$query);
$res=mysqli_fetch_assoc($result);
$query="select * from user_m where id = {$_SESSION['mid']}";
$B=execute($link,$query);
$b=mysqli_fetch_assoc($B);
$query="select count(*) from reply where content_id={$cid}";
$count_reply=num($link, $query);
$page_size=10;
$page=page($count_reply,$page_size);
echo '<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" >
<title>树洞 - 说出你心底的秘密 </title>	
<meta name="keywords" content="树洞 秘密 晒秘密 忏悔 糗事 倾诉">
<meta name="description" content="现实中没有发出的声音，请把它留在这里！放下心底的包袱，继续远行。">
<link href="./CSS/common.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="banner">';
if(!isset($_SESSION['loginStatus'])||!$_SESSION['loginStatus']) {
    echo "<div class=\"tip\">
        <a href=\"login.php\" class=\"act\">登录</a>
	    <span class=\"sline\">|</span>
	    <a href=\"register.php\" >注册</a>
    </div>";
}else {
    echo"<div class=\"tip\">
        <a href=\"#\" class=\"act\">{$b['name']}</a>
	    <span class=\"sline\">|</span>
	    <a href=\"logout.php\" >退出</a>
    </div>";
}
echo '</div>
<!--banner-->
<div class="main">
<div class="shadow">
    <div class="wrap">
        <div class="left">
        	<div class="sels">
	            <a href="index.php" class=\"act\">所有秘密</a>
	            <span class="sline">|</span>
	            <a href="hot.php" >热门秘密</a>
	            <span class="sline">|</span>';
	            echo" <a href=\"info.php\" >我的秘密</a>";
               echo' <span class="sline">|</span>
	            <a href="post.php" >发布秘密</a>
	        </div>
             <div class="secret_show"> ';
echo " <div class=\"pbox\"><img src=\"http://image.xinli001.com/20121014/155022ec4bbef7def1ae0f.jpg!50\" width=\"50\" height=\"50\" alt=\"匿名\"></a></div>
               <div class=\"infos\">
                    <p>匿名&nbsp; <span class=\"fgrey\">{$res['time']}</span></p>
                    <p class=\"descs\">{$res['content']}</p>
                    <div class=\"tool\">
                        <a href=\"#\" data-url=\"/hole/745/vote/\">鼓励<span class=\"fgrey\">(<span id=\"id_vote_745\">4561</span>)</span></a>
                    </div>
                </div>
                <br class=\"clear\">
            </div>";
if(!isset($_SESSION['loginStatus'])||!$_SESSION['loginStatus']) {
    echo"    <div class=\"clist\">
                <a name=\"comments\"></a>
                <h2>所有留言<a href=\"#postcomment\" class=\"me\">我来留言</a></h2>";
}
else {
   echo" <div class=\"comment\">
                <form method=\"post\" action=\"common_check.php?cid={$cid}\">
                <textarea name=\"content\" class=\"content\"></textarea>
                
                <input class=\"publish\" type=\"submit\" name=\"submit\" value=\"评论\" />
                 <label for=\"anonymous\" class=\"anonymous\">
						<input type=\"checkbox\"  id=\"anonymous\" name=\"anonymous\" value=\"1\">
						匿名发贴
				</label>
            <div style=\"clear:both;\"></div>
        </form>
            </div>
            <div class=\"clist\">
                <a name=\"comments\"></a>
                <h2>所有留言</h2>";
}
$query="select * from reply where content_id ={$cid} order by time DESC {$page['limit']}";
$result=execute($link, $query);
while($data=mysqli_fetch_assoc($result)) {
    echo "<div class=\"items\" id=\"id_comment_99993506\">
                    <div class=\"pbox\"><img src=\"http://image.xinli001.com/20121014/155022ec4bbef7def1ae0f.jpg!50\" width=\"50\" height=\"50\" alt=\"匿名\"></a></div>
                    <div class=\"cshow\">
                        <span class=\"arrow\"></span>";
    if ($data['user_id'] == 0)
        echo "<p>匿名<span class=\"quote\">：</span>{$data['reply']}</p>";
    else {
        $query = "select * from user_m where id = {$data['user_id']}";
        $A = execute($link, $query);
        $a = mysqli_fetch_assoc($A);
        echo "<p>{$a['name']}<span class=\"quote\">：</span>{$data['reply']}</p>";
    }
    echo "<p class=\"date\">{$data['time']}</p>
                    </div>
                </div>";
}
               echo" <div class=\"pagebar\" id=\"pages\">
                {$page['html']}
</div>
            </div>";

      echo'</div>
    </div>
</div>
</body>
</html>';
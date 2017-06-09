<?php
include_once './inc/mysql.inc.php';
include_once './inc/config.inc.php';
include_once './inc/page.inc.php';
$link=connect();
if(!isset($_SESSION['loginStatus'])||!$_SESSION['loginStatus']){
    echo"<script>alert ('请先登录，再发声！');
                 location.href='login.php';
               </script>";
}
$query="select * from content where user_id = {$_SESSION['mid']} ORDER by id DESC {$page['limit']}";
$result=execute($link, $query);
$count_reply=num($link, $query);
$page_size=10;
$page=page($count_reply,$page_size);
echo "<!DOCTYPE HTML>
<html>
<head>
<meta charset=\"utf-8\" >
<title>树洞 - 说出你心底的秘密 </title>	
<meta name=\"keywords\" content=\"树洞 秘密 晒秘密 忏悔 糗事 倾诉\">
<meta name=\"description\" content=\"现实中没有发出的声音，请把它留在这里！放下心底的包袱，继续远行。\">
<link href=\"./CSS/index.css\" rel=\"stylesheet\" type=\"text/css\">
</head>
<body>
<div class=\"banner\">";
if(!isset($_SESSION['loginStatus'])||!$_SESSION['loginStatus']) {
    echo "<div class=\"tip\">
        <a href=\"login.php\" class=\"act\">登录</a>
	    <span class=\"sline\">|</span>
	    <a href=\"register.php\" >注册</a>
    </div>";
}else {
    echo"<div class=\"tip\">
        <a href=\"#\" class=\"act\">{$_SESSION['name']}</a>
	    <span class=\"sline\">|</span>
	    <a href=\"logout.php\" >退出</a>
    </div>";
}
echo"</div>
<div class=\"main\">
    <div class=\"shadow\">
	<div class=\"wrap\">
		<div class=\"left\">
			<div class=\"sels\">
	            <a href=\"index.php\" >所有秘密</a>
	            <span class=\"sline\">|</span>
	            <a href=\"hot.php\" >热门秘密</a>
	            <span class=\"sline\">|</span>";
echo" <a href=\"info.php\" class=\"act\">我的秘密</a>";
echo" <span class=\"sline\">|</span>
	            <a href=\"post.php\" >发布秘密</a>
	        </div>
            <div class=\"lists\">";
while($data=mysqli_fetch_assoc($result)){
    echo"<div class=\"items\" id=\"id_secret_100322930\">
                    <div class=\"pbox\">
	                    <a href=\"comment.php?id={$data['id']}\"><img src=\"http://image.xinli001.com/20121014/155022ec4bbef7def1ae0f.jpg!50\" width=\"50\" height=\"50\" alt=\"卓然\"></a>
                    </div>
                    <div class=\"infos\">
		                <span class=\"arrow\"></span>
		                <div class=\"secret\">
			                <p class=\"descs\">{$data['content']}</p>
			                <p class=\"author\">";
    if($data['user_id']==0)
        echo"<a href=\"#\">匿名</a>&nbsp; <span class=\"fgrey\">{$data['time']}</span>";
    else {
        $query="select * from user_m where id = {$data['user_id']}";
        $A=execute($link,$query);
        $res=mysqli_fetch_assoc($A);
        echo "<a href=\"#\">{$res['name']}</a>&nbsp; <span class=\"fgrey\">{$data['time']}</span>";
    }
    echo"<span class=\"tool\">  <a href=\"praise_check.php?q={$data['id']}\" class=\"zan\">鼓励<span class=\"fgrey\">(<span id=\"id_vote_100322930\">{$data['zan']}</span>)</span></a> &nbsp; <a href=\"comment.php?id={$data['id']}\">留言<span class=\"fgrey\">(<span id=\"id_commentnum_100322930\">{$data['comment']}</span>)</span></a> </span>
			                </p>
		                </div>
	                </div>
	                <br class=\"clear\">
                </div>";
}
if($count_reply>10) {
    echo '<div style="width:100%;height:100px;"></div>';
    echo "{$page['html']}";
}
echo'</div>
		</div>
	</div>
    </div>
</div>
</body>
</html>';

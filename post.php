<?php
error_reporting(E_ALL^E_NOTICE);
include_once './inc/config.inc.php';
include_once './inc/mysql.inc.php';
if(!isset($_SESSION['loginStatus'])||!$_SESSION['loginStatus']){
    echo"<script>alert ('请先登录，再发声！');
                 location.href='login.php';
               </script>";
}

echo '<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" >
<title>发贴-树洞</title>
<meta name="keywords" content="树洞 秘密 晒秘密 忏悔 糗事 倾诉">
<meta name="description" content="现实中没有发出的声音，请把它留在这里！放下心底的包袱，继续远行。">
<link href="./CSS/past.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main">
    <div class="content-block">
        <div class="col1">
<div class="block">

<div class="new_article" style="position: relative;">
	<form method="post" name="form1" id="form1" action="post_check.php">	
		<table>
			
			<tbody><tr>
				<td>内容：</td>
				<td><div class="ke-container ke-container-default" style="position:relative;width:500px;">
                    <div style="display:block;" class="ke-toolbar" unselectable="on">
                        <span class="ke-outline" data-name="removeformat" title="删除格式" unselectable="on">
                            <span class="ke-toolbar-icon ke-toolbar-icon-url ke-icon-removeformat" unselectable="on"></span>
                        </span>
                    </div>
                    <div style="display: block; height: 169px;" class="ke-edit">
                        <textarea class="ke-edit-textarea" name="content" style="width: 100%; height: 169px;"></textarea>
                    </div>
                    <div class="ke-statusbar">
                        <span class="ke-inline-block ke-statusbar-center-icon"></span>
                        <span class="ke-inline-block ke-statusbar-right-icon" style="visibility: hidden;"></span>
                    </div>
                </div>
                
					 
					
					<input type="hidden" id="hidden" value="0">
				</td>
			</tr>
			
		</tbody></table><table>	
			<tbody>
			<tr>
				<td colspan="2">
					<input type="submit"  name="submit" value="发 布" class="addbutton">
					<label for="anonymous">
						<input type="checkbox" id="anonymous" name="anonymous" value="1">
						匿名发贴
					</label>
 
					
				</td>
			</tr>
		</tbody></table>
    </form>
	</div>
<div style="margin:20px 0;font-size:12px;line-height:160%;padding:2 0 0 0;">
<h3 style="font-size:20px;margin:1.12em 0;border-top:1px solid #efefef;padding:20px 0 0 0;display:block;">投稿须知</h3>
<ol style="list-style-position: inside;margin: 2em 0;list-style-type: decimal;">
<li>请不要包发表与秘密无关的内容。</li>
<li>秘密经过审核后发布。</li>
<li>请勿发布广告或留下自己联系方式。</li>
<li>请至少填写10个字以上。</li>
</ol>

<p></p>
</div>
</div>
<div class="shadow"></div>

</div>
    </div>
</div>
</body>
</html>';


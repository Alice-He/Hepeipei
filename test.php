<?php
require("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="./css/index.css">
    <link type="text/css" rel="stylesheet" href="./css/thread.css">
    <script type="text/javascript">
        /*-- - - - - - - - - - - - - 点赞!- - - - - - - - - - - - --*/

        function praise(post_id){
            if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {
                // IE6, IE5 浏览器执行代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("no_of_praise").innerHTML="("+xmlhttp.responseText+")";
                }
            }
            xmlhttp.open("GET","praise.php?q="+post_id,true);
            xmlhttp.send();
        }
        </script>
</head>
<body>
        <div class="praise" onclick="praise($topic_id)"></div><span id="no_of_praise">
<?php
require("conn.php");
$post_id=$_GET["q"];
$sql="SELECT no_of_hit FROM topic WHERE ID = $post_id";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$row["no_of_hit"]++;
$sql="UPDATE topic set no_of_hit = $row[no_of_hit] WHERE ID=$post_id";
$conn->query($sql);
echo $conn->error;
$response=$row["no_of_hit"];
echo $response;
?>
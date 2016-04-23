﻿<?php
include 'common.php' ;
header('Content-type:text/html;charset=utf');
mysql_conn();
?>

<p>

    为什么会有这认证码呢,是因为上次小明的老板来巡视的时候,发现这个系统储存了很多重要的信息,所以他希望这个系统变得更安全,然后他就啪啪啪的写了几行代码,<br>
    然后就让自己的qq号变成了认证码了.<br>
    虽然这让系统变得更安全,但是就苦了我们的小明了. 因为老板的qq号是个垃圾号, 十分的难记. 每次登陆系统的时候,小明就必须去翻一下本地的记录,找到qq号.<br>
但是时间长了,小明实在觉得很烦, 就决定把老板的qq号记录进数据库,然后每次就进去这个界面,用某种不为人知的方法来得到qq号.<br>
</p>

<center><form action="search.php" method="POST">
<input type="text" name="search">
<input type="submit" value="Search"></center>
<br>

<?php
if(!empty($search)){
    $result = mysql_fetch_array(mysql_query("select qq from qq where qq like '$search'"));
    mysql_close();
    if($result){
        echo "<center style=\"font-size:36px; color:red\">$result[qq]</center>";
    }else{
        echo "<center style=\"font-size:36px; color:red\">无此记录</center>";
    }
}
?>
<center><a href="login.php?act=login">再次尝试登录。</a></center>

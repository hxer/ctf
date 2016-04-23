<?php
include('common.php');
include('function.php');
session_start();
header('Content-type:text/html;charset=utf-8');
mysql_conn();

if ($_SESSION[login] == 1) {
    header('Location:/sgbm/admin_index.php');
}

if ($_SESSION[checkcode] == 1) {
    ?>

    <center style="color:red;font-size:24">后台管理</center><br>
    <form action="login.php" method="POST">
        用户名:<input type="text" id="username" name="username" size="50px"><br>
        密 码 :<input type="text" id="password" size="50px" name="password">
        <br>
        <input type="submit" value="Submit to login" name="submit">
    </form>
    <?php

    if ($submit) {

        if ($email && !preg_match("/\A\w+[-+_]*\s?\w+@\w+\.\w{2,4}(\Z|\.\w{2,4})/", $email)) {  //允许输入 yu@qq.com || yu@qq.com.cn || yu_a@qq.com || yu-x@qq.com
                exit("Email Wrong!");
        }

        foreach ($_REQUEST as $key => $value){
            if (strpos($value, '(')) {
                    $filter = "UNION.+?SELECT|SELECT.+?FROM|MD5|0x|\/\*|\.\.\/|\.\/";
                    webscan_St0pAttack($key, $value, $filter, "GET");
            }
        }

        if(empty($id)){
            $id = 0;
        }

        $id=preg_replace('#[^\w\s]#i','',$id);

        if (strlen($username) > 20) {
            $username = substr($username, 0, 20);
        }

        if ($act == 'login') {
            $sql = "select * from admin where username='$username' or id='$id' or email = '$email'";
            $result = @mysql_fetch_array(mysql_query($sql));

            mysql_close();

            if ($result) {
                if (think_ucenter_md5($password, $result['salt']) === $result['password']) {
                    $_SESSION['login'] = 1;
                    $_SESSION['auth'] = 1;
                    echo "<center style=\"font-size:36px; color:red\"><a href=\"./sgbm/admin_index.php\">Click jump to the Backstage</a></center>";
                } else {
                    exit('<script>alert("Password of the account is not right")</script>');
                }
            } else {
                exit('<script>alert("The account is not exists")</script>');
            }
        } else {
            exit('<script>alert("Please login!login!login!login!login!login!login!login!login!login!login!login!")</script>');
        }
    }
} else {
    ?>

    <?php
    $result = mysql_fetch_array(mysql_query("select qq from qq limit 1"));
    mysql_close();
    $qq = $result[qq]; ?>

    <form action="login.php" method="GET">
        <p style="text-align: center; color: red">凭认证码进入后台</p>
        <center>认证码:<input type="text" name="admincode">  <input type="submit" value="check"></center>

    </form>
    <?php

    if (!empty($admincode)) {
        if ($admincode != $qq) {
            echo '<script>alert("认证码错误")</script>';
            exit ('<script language=javascript>window.location.href="search.php"</script>');
        } else {
            $_SESSION[checkcode] = 1;
            echo '<script language=javascript>window.location.href="login.php"</script>';
        }

    }
}
?>

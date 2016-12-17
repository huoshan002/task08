<?php

require_once('db.php');

session_start();

function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
};

//注销登录
if (_get('action') == 'logout') {
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    echo '注销登录成功！';
    header("url=../admin/login.html");
    exit();
} else {

//登录
    if (!isset($_POST['submit'])) {
        exit('非法访问!');
    }
    $username = trim($_POST['username']);
    $password = MD5($_POST['password']);


//检测用户名及密码是否正确
    $sql = "SELECT `uid` FROM `user` WHERE `username`='{$username}' AND `password`='{$password}' limit 1";

    $query = mysqli_query($Link, $sql);

    if ($result = mysqli_fetch_array($query)) {
        //登录成功
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $result['uid'];
        echo $username, '登录成功！2s后跳转登录';
        header("refresh:2;url=../admin/index.php");

        exit();
    } else {

        //检查用户名或是密码错误
        $sql_username = "SELECT `uid` FROM `user` WHERE `username` = '{$username}' limit 1";

        $query_username = mysqli_query($Link, $sql_username);

        if (mysqli_fetch_array($query_username)) {
            echo '密码错误，请重新输入！';
            exit();
        } else {
            echo '用户名不存在！';
        }

        exit();
    }

}

?>
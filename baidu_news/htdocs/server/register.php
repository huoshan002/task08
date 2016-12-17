<?php

if (!isset($_POST['submit'])) {
    exit('非法访问!');
}

require_once('db.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

//检测用户名是否已经存在
$sql = "SELECT `uid` FROM `user` WHERE `username` = '{$username}' limit 1";

$query = mysqli_query($Link,$sql);

if (mysqli_fetch_array($query)) {
    echo '错误：用户名 ', $username, ' 已存在!';
    exit();
}

//添加用户
$password = MD5($password);
$regdate = date('y-m-d H:i:s',time());

$sql = "INSERT INTO `user`(`username`,`password`,`email`,`regdate`)VALUES('{$username}','{$password}','{$email}','{$regdate}')";

if (mysqli_query($Link, $sql)) {
    echo '用户注册成功! 2s后跳转登录...';
    header("refresh:2;url=../admin/index.php");
    exit();
} else {
    echo '添加数据失败：'.mysqli_error();
}

?>
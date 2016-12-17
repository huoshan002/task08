<?php

require_once('db.php');

if($Link){

    $newsTitle = addslashes($_POST['newsTitle']);
    $newsType = addslashes($_POST['newsType']);
    $newsImg = addslashes($_POST['newsImg']);
    $newsTime = addslashes($_POST['newsTime']);
    $newsSrc = addslashes($_POST['newsSrc']);

    //插入新闻sql
    $sql = "INSERT INTO `news` (`newsTitle`,`newstype`,`newsimg`,`newstime`,`newssrc`) VALUES ('{$newsTitle}','{$newsType}','{$newsImg}','$newsTime','$newsSrc')";

    mysqli_query($Link,"SET NAMES utf8");
    mysqli_query($Link,$sql);

    echo json_encode(array('success'=>'ok'));
}

mysqli_close($Link);

?>
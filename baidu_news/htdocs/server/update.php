<?php

require_once('db.php');

if($Link){

    $newsTitle = addslashes($_POST['newstitle']);
    $newsType = addslashes($_POST['newstype']);
    $newsImg = addslashes($_POST['newsimg']);
    $newsTime = addslashes($_POST['newstime']);
    $newsSrc = addslashes($_POST['newssrc']);
    $newsId = addslashes($_POST['id']);


    //更新新闻sql
    $sql = "UPDATE `news` SET `newstitle`='{$newsTitle}',`newstype`='{$newsType}',`newsimg`='{$newsImg}',`newstime`='{$newsTime}',`newssrc`='{$newsSrc}' WHERE `id`={$newsId}";

    mysqli_query($Link,"SET NAMES utf8");
    mysqli_query($Link,$sql);

    echo json_encode(array('success'=>'ok'));
}

mysqli_close($Link);

?>
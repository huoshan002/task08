<?php

require_once('db.php');

if($Link){
    $newsid = $_POST['newsid'];

    $sql = "DELETE FROM `news` WHERE `news`.`id` = {$newsid}";

    mysqli_query($Link,"SET NAME utf8");
    mysqli_query($Link,$sql);

    echo json_encode(array('success'=>'ok'));
}

mysqli_close($Link);
?>
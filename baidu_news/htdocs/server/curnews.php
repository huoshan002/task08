<?php

require_once('db.php');

if($Link){
    $newsid = $_GET['newsid'];

    $sql = "SELECT * FROM `news` WHERE `id` = {$newsid}";

    mysqli_query($Link,"SET NAMES utf8");
    $result = mysqli_query($Link,$sql);

    $senddata = array();

    while($row = mysqli_fetch_assoc($result)){
        array_push($senddata,array(
            'id' => $row['id'],
            'newstype' => htmlspecialchars_decode($row['newstype']),
            'newstitle' => htmlspecialchars_decode($row['newstitle']),
            'newsimg' => htmlspecialchars_decode($row['newsimg']),
            'newstime' => htmlspecialchars_decode($row['newstime']),
            'newssrc' => htmlspecialchars_decode($row['newssrc']),
        ));
    };

    echo json_encode($senddata);

}

mysqli_close($Link);
?>
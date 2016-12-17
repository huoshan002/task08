<?php

require_once('db.php');

if($Link){

    $newstype = $_GET['newstype'];

    if( $newstype == '' || $newstype == null ){

        //查询所有数据
        $sql = "SELECT * FROM news order by id desc";

        mysqli_query($Link,"SET NAMES utf8");
        $result = mysqli_query($Link,$sql);

        $senddata = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($senddata,array(
                'id' => $row['id'],
                'newstype' => htmlspecialchars($row['newstype']),
                'newstitle' => htmlspecialchars($row['newstitle']),
                'newsimg' => htmlspecialchars($row['newsimg']),
                'newstime' => htmlspecialchars($row['newstime']),
                'newssrc' => htmlspecialchars($row['newssrc']),
            ));
        };

        echo json_encode($senddata);

    }else {
        //查询分类数据
        $sql = "SELECT * FROM news WHERE `newstype`='{$newstype}' order by id desc";


        mysqli_query($Link,"SET NAMES utf8");
        $result = mysqli_query($Link,$sql);

        $senddata = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($senddata,array(
                'id' => $row['id'],
                'newstype' => htmlspecialchars($row['newstype']),
                'newstitle' => htmlspecialchars($row['newstitle']),
                'newsimg' => htmlspecialchars($row['newsimg']),
                'newstime' => htmlspecialchars($row['newstime']),
                'newssrc' => htmlspecialchars($row['newssrc']),
            ));
        };

        echo json_encode($senddata);

    };

}else{
    echo json_encode(array('success'=>'none'));
}

mysqli_close($Link);

?>

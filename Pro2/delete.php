<?php
//connect to database
require_once("./conn.php");

//Logic
if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];

    //sql query
    $sql = "DELETE FROM `crud` WHERE `id`='$id'";

    $result = $db->query($sql);

    if(!$result){
        textAlert(classmsg:'error',msg:'SQL error');
    }else{
        header("location: display.php");
    }

    $db->close();

}



function textAlert($classmsg,$msg){
    $element = "<h6 class='$classmsg'>$msg</h6>";
    echo $element;
}




?>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 13:00
 */
class vcode_create{
var $dbname="root";
var $dbpass="root";
var $dbhost="127.0.0.1";
var $dbdatabase="vcode";


function create(){
    $ccode = rand(1,30324);
    $strsql="select andwer from `sd_vcode` where `id` = '$ccode' limit 1";

    $db_connect= new mysqli($this->dbhost,$this->dbname,$this->dbpass,$this->dbdatabase);

    $result=$db_connect->query($strsql);
    while ($rows = $result -> fetch_object()){
        $answer = $rows -> answer;
    }
    $return=array(
        'code'=>200,
        'vcode_id'=>$ccode,
        'vcode_image'=>'http://'.$_SERVER['HTTP_HOST'].'image.php?'.$ccode,
        'vcode_answer'=>$answer,
        );
    return $return;
}
function check($id){
    
}

}
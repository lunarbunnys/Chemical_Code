<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 13:00
 */
class vcode{
var $dbname="root";
var $dbpass="root";
var $dbhost="127.0.0.1";
var $dbdatabase="vcode";


function create(){
    $ccode = rand(1,30324);
    $strsql="select anwser from `sd_vcode` where `id` = '$ccode' limit 1";

    $db_connect= new mysqli($this->dbhost,$this->dbname,$this->dbpass,$this->dbdatabase);

    $result=$db_connect->query($strsql);
    var_dump($db_connect->error);
    while ($rows = $result -> fetch_object()){
        $anwser = $rows -> anwser;
    }

    $return=array(
        'code'=>200,
        'vcode_id'=>$ccode,
        'vcode_image'=>stripcslashes('http://'.$_SERVER['HTTP_HOST'].'/image.php?code='.$ccode),
        'vcode_answer'=>$anwser,
        );
    return json_encode($return,JSON_UNESCAPED_SLASHES);
}
function check($id){

}

}
$vcode= new vcode();
echo $vcode->create();

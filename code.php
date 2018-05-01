<?php 
session_start();
unset($_SESSION["vcode"]);
// $code = $_POST['code'];
Header('Content-type: image/PNG');
// echo "验证码系统-随机取出测试"."</br>";

// echo "Powered By 月光兔</br>";
$status = "";
$success = "";
$scookies = "";
$ccode = rand(1,30324);
  // echo $ccode." </br>";


    $dbname="root";
    $dbpass="741205Dhw";
    $dbhost="127.0.0.1";
    $dbdatabase="vcode";
 
    //生成一个连接
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    // 获取查询结果
    $strsql="select * from `sd_vcode` where `id` = '$ccode' limit 1";
    $result=$db_connect->query($strsql);
	while($row=$result->fetch_array()){
            // echo "ID:".$row["id"]."验证代码：".$row[1]."密码：".$row["anwser"]."<br />";
			
	$image = "http://www.chemicalbook.com/CAS/GIF/".$row[1].".gif";
	// echo $image."</br>";
	
    $imagedata = file_get_contents($image);
	
	$im = imagecreatefromstring($imagedata);
	
	imagegif($im);
	
	imagedestroy($im);
    $_SESSION["vcode"] = $row["anwser"];

	}
	// echo $result;
	// $image = "http://www.chemicalbook.com/CAS/GIF/".$row[1].".gif";
	// echo $image;
	// echo file_get_contents($image);
	?>
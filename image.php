<?php 
session_start();
unset($_SESSION["vcode"]);
// $code = $_POST['code'];
Header('Content-type: image/GIF');


// echo "Powered By lunarbunnys</br>";

$ccode = $_GET['code'];
//$ccode = rand(1,30324);
  // echo $ccode." </br>";


    $dbname="root";
    $dbpass="password";
    $dbhost="127.0.0.1";
    $dbdatabase="vcode";
 
    //����һ������
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    // ��ȡ��ѯ���
    $strsql="select * from `sd_vcode` where `id` = '$ccode' limit 1";
    $result=$db_connect->query($strsql);
	while($row=$result->fetch_array()){

	$image = "https://www.chemicalbook.com/CAS/GIF/".$row[1].".gif";
        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ];

        $imagedata = file_get_contents($image,false, stream_context_create($stream_opts));
	
	$im = imagecreatefromstring($imagedata);
	
	imagegif($im);
	
	imagedestroy($im);
    $_SESSION["vcode"] = $row["anwser"];

	}


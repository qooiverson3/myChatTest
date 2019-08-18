<?php

define("file","/Users/wesley/Desktop/IP_POOL_EXT.txt");
$fp = fopen(file,'r') or die('Can not open this File!');
$fr = fread($fp,filesize(file));    fclose($fp);

$string = str_replace(array("\"",","),array("",""),$fr);
$arr = explode("\n",$string);
$data = [];
$result = new stdClass();

foreach ($arr as $value) {
    $arr2 = explode(" := ",$value);
    $data['profile'] = $arr2[0];
    $data['domain'] = $arr2[1];
    $result->status = 'successfully';
    $result->ipv4_content[] = $data;

}
header("Content-type: application/json");
echo json_encode($result);


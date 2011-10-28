<?php

/*
function array2str($arr);
function array2strWithAnd($arr);
function postData($url,$data);

*/















function array2str($arr)
{

$aim = '';
$tmp = array();


$keys = array_keys($arr);
$values = array_values($arr);
//print_r($keys);

for($i = 0;$i<sizeof($arr);$i++)  $tmp[] = $keys[$i].'='.$values[$i];
sort($tmp);
foreach($tmp as $str) $aim .= $str;


return $aim;
}


function array2strWithAnd($arr)
{
$aim = '';
$keys = array_keys($arr);
$values = array_values($arr);

for($i = 0;$i<sizeof($arr);$i++)
{
$aim.= $keys[$i].'='.$values[$i].'&';
}
return substr($aim,0,-1);
}


function postData($url,$data)
{

$ch = curl_init();
$timeout = 5;
curl_setopt ($ch, CURLOPT_URL, $url); //地址
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_POST,true); //设置POST方式
curl_setopt($ch, CURLOPT_POSTFIELDS,array2strWithAnd($data));//发送的post值
$content = curl_exec($ch);//获得返回值
curl_close($ch);
//print_r(json_decode($content));
return json_decode($content);
}


function simple_api($op,$data = array())
{
global $api_key;
global $secret_key;
global $api_version;
global $return_format;
global $api_url;

$data["method"] = $op;

$data["api_key"] = $api_key;
$data["session_key"] = $_SESSION["session_key"];

$data["access_token"] = $_SESSION["access_token"];
$data["v"] = $api_version;
$data["format"] = $return_format;

$data["sig"]  = md5(array2str($data).$secret_key);

//print_r($data);
$ch = curl_init();
$timeout = 5;
//echo $url;
curl_setopt ($ch, CURLOPT_URL, $api_url); //地址
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_POST,true); //设置POST方式
curl_setopt($ch, CURLOPT_POSTFIELDS,array2strWithAnd($data));//发送的post值
$content = curl_exec($ch);//获得返回值
//echo $content;
curl_close($ch);

return json_decode($content);
}


function api($op,$data = array())
{
//global $secret_key;
//global $api_version;
//global $return_format;
//global $api_url;

//$data["method"] = $op;
//$data["access_token"] = $_SESSION["access_token"];
//$data["v"] = $api_version;
//$data["format"] = $return_format;

$data["sig"]  = md5(array2str($data).$secret_key);

//print_r($data);
$ch = curl_init();
$timeout = 5;
//echo $url;
curl_setopt ($ch, CURLOPT_URL, $api_url); //地址
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_POST,true); //设置POST方式
curl_setopt($ch, CURLOPT_POSTFIELDS,array2strWithAnd($data));//发送的post值
$content = curl_exec($ch);//获得返回值
//echo $content;
curl_close($ch);

return json_decode($content);
}










?>
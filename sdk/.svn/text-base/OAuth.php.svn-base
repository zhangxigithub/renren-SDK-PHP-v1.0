<?php


function zx_login($code)
{

session_start();
$aim = array();

global $api_key;
global $secret_key;
global $redirect_uri;

//get token
$aim["client_id"] = $api_key;
$aim["client_secret"] = $secret_key;
$aim["redirect_uri"] = $redirect_uri;
$aim["grant_type"] = "authorization_code";
$aim["code"] = $code;
$token_arr = postData("https://graph.renren.com/oauth/token",$aim);
//print_r($token_arr);
unset($aim);

//get session key
$aim["oauth_token"] = $token_arr->access_token;
$session_key_arr = postData("https://graph.renren.com/renren_api/session_key",$aim);
//print_r($session_key_arr);
$session_key = $session_key_arr->renren_token->session_key;
unset($aim);

$_SESSION["access_token"] = $token_arr->access_token;
$_SESSION["session_key"] = $session_key;
return $token_arr->access_token;
}



















































?>
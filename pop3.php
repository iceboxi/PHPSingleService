<?php
header("Content-Type:text/html; charset=utf-8");
//使用 POP3 伺服器作身份認證
$server = '伺服器';
$port = '110';

$userid = '帳號';
$password = '密碼';

//檢查 $server $port 是否可以開啟
$fp = fsockopen ($server, $port, $errno, $errstr, 5);
if(!$fp) die('連線失敗');

//檢查 POP3 伺服器連線是否成功
$msg = fgets($fp, 256);
if(strpos($msg,"+OK")===false) 
	die('POP3 伺服器連線失敗'); 

//傳送帳號
fputs($fp, "USER $userid\r\n");
$msg = fgets($fp,256);
if(strpos($msg,"+OK")===false) 
	die('帳號有誤');
 

//傳送密碼
fputs($fp, "PASS $password\r\n");
$msg = fgets($fp,256);
if(strpos($msg,"+OK")===false) 
	die('密碼有誤');

else echo "OK";

fputs($fp, "QUIT\r\n");
$msg = fgets($fp,256);
fclose($fp);

?>
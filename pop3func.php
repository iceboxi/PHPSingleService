<?php
header("Content-Type:text/html; charset=utf-8");
 
echo (CheckPOP3("server","account","password"));


function CheckPOP3($server,$id,$passwd,$port=110){

  	//
	if (empty($server)||empty($id)||empty($passwd))
  		return "empty";

  	//connect to POP3 Server
  	$fs = fsockopen ($server, $port, &$errno, &$errstr, 5);

  	//check connect
  	if (!$fs)
  		return "not connected";

	//connected..
	$msg = fgets($fs,256);
	if(strpos($msg,"+OK")===false) 
		return "POP3 connect err";

	//step 1. check account
	fputs($fs, "USER $id\r\n");
	$msg = fgets($fs,256);
	if (strpos($msg,"+OK")===false)
		return "account err";

	//step 2. ckeck password
	fputs($fs, "PASS $passwd\r\n");
	$msg = fgets($fs,256);
	if (strpos($msg,"+OK")===false)
		return "password err";

	//step 3. QUIT
	fputs($fs, "QUIT \r\n");
	fclose($fs);

	return "OK";
}
?>
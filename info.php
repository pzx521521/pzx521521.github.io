<?php	
	header('Content-type:text/json');  
	
	$contactName =(string)$_GET['contactName'];
	$contactEmail =(string)$_GET['contactEmail'];
	$contactSubject =(string)$_GET['contactSubject'];
	$contactMessage =(string)$_GET['contactMessage'];
	$arr['result'] ['contactName'] = $contactName;
	$arr['result'] ['contactEmail'] = $contactEmail;
	$arr['result'] ['contactSubject'] = $contactSubject;
	$arr['result'] ['contactMessage'] = $contactMessage;
	echo json_encode($arr); //输出JSON数据
	echo json_encode("提交成功"); //输出JSON数据
?>
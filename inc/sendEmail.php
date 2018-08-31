<?php

require_once '../../aliSMS/api_demo/SmsDemo.php';
// Replace this with your own email address
$siteOwnersEmail = 'pzx521521@qq.com';


if($_POST) {
	
   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));
   $error=array();
   // Check Name
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}
	// Check Message
	if (strlen($contact_message) < 15) {
		$error['message'] = "Please enter your message. It should have at least 15 characters.";
	}
   // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }



   if (count($error)==0) {
		// 调用示例：
	$myfile = fopen("msg.txt", "w") or die("Unable to open file!");

	fwrite($myfile, $name);
	fwrite($myfile, $email);
	fwrite($myfile, $subject);
	fwrite($myfile, $contact_message);
	fclose($myfile);
	echo "已给作者发送短信~ 马上回复您<br>";
	echo "短信发送信息如下:";

	set_time_limit(0);
	header('Content-Type: text/plain; charset=utf-8');

	$response = SmsDemo::sendSms(
		"彭子旭", // 短信签名
		"SMS_106970114", // 短信模板编号
		"18868826592", // 短信接收者
		Array(  // 短信模板中字段的值
			"code"=>$name,
			"product"=>"有人找你"
		),
		"123"   // 流水号,选填
	);
	echo "发送短信(sendSms)接口返回的结果:\n";
	print_r($response);

	sleep(2);

	$response = SmsDemo::queryDetails(
		"18868826592",  // phoneNumbers 电话号码
		"20170718", // sendDate 发送时间
		10, // pageSize 分页大小
		1 // currentPage 当前页码
		// "abcd" // bizId 短信发送流水号，选填
	);
	echo "查询短信发送情况(queryDetails)接口返回的结果:\n";
	print_r($response);	
	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>
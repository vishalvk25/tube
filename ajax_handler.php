<?php
session_start();
error_reporting(1);

// Report all errors
error_reporting(E_ALL);
require_once("connection/connt.php");
$input_data = json_decode($_POST['data_json'],true);
$input = $input_data['basic'];
function OTP_Generator($length = 6, $chars = '0123456789'){
    $chars_length = (strlen($chars) - 1);
    $string = $chars{rand(0, $chars_length)};
    for ($i = 1; $i < $length; $i = strlen($string)){
        $r = $chars{rand(0, $chars_length)};
        if ($r != $string{$i - 1}) $string .=  $r;
    }
    return $string;
}
function SendMessage($phone, $m) {
  $apiKey = urlencode('BohOYlWO6eA-dIUncqQwqHAKUZwmYbt0kGZePDPzEa');
	$sender = urlencode('TXTLCL');
	$message = rawurlencode($m);
	$numbers = $phone;
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}
if($input['method'] == 'OTP'){
    $_SESSION['otp']=OTP_Generator();
    $m="Your OTP is ".$_SESSION['otp'];
    $response = SendMessage($input['mobile_no'], $m);
    echo json_encode(array('status'=>true,'message'=>"OTP Sent Successfully...",'response'=>$response));
}elseif($input['method'] == 'raise_ticket'){
    // if($input['OTP']==$_SESSION['otp']){
      $tokenno= 'WARD22-A-'.$input['quarter_no'];
      $sql1= "SELECT *  FROM `tickets` WHERE `token_no` LIKE '".$tokenno."' AND `datetime` > '".date('Y-m-d H:i:s', strtotime('-8 day'))."'";
      $result = $conn->query($sql1);
      if ($result->num_rows > 0) {
        $m="Note: Your next registration will be done after 8 days. आपका अगला नया पंजीकरण 8 दिन बाद ही हो पाएगा।";
        $response = SendMessage($input['mobile_no'], $m);
        echo json_encode(array('status'=>false,'message'=>"Ticket Already Generated"));
      }else{
        $sql="INSERT INTO `tickets` (`token_no`, `name`, `quarter_type`, `quarter_no`, `complaint_for`, `mobile_no`) VALUES ('" . $tokenno . "','".$input['name']."','".$input['quarter_type']."','".$input['quarter_no']."','".$input['complaint_for']."','".$input['mobile_no']."')";
        $result = $conn->query($sql);
        $m="Reg no. ".$tokenno." Thanks for problem registration,an attempt will be made to resolve your issue as soon as possible. समस्या पंजीकरण के लिए धन्यवाद,जल्द से जल्द आपकी समस्या के समाधान का प्रयास किया जाएगा (team apnasudhir)";
        $response = SendMessage($input['mobile_no'], $m);
        echo json_encode(array('status'=>true,'message'=>"Ticket Raised Successfully! Complaint Id is ".$tokenno));
      }
    // }else{
    //     echo json_encode(array('status'=>false,'message'=>"Invalid OTP Try Again"));
    // }
  }elseif($input['method'] == 'raise_ticket_a'){
        $sql ='SELECT MAX(ticket_id) as ticket FROM `tickets-a`';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $ID = $row['ticket'];
          $ID = $ID+1;
        }else{
          $ID = '1';
        }
        $tokenno= 'WARD22-A-'.$ID;
        $sql1= "SELECT *  FROM `tickets-a` WHERE `quarter_type` = '".$input['quarter_type']."' AND `quarter_no`= '".$input['quarter_no']."'  AND `datetime` > '".date('Y-m-d H:i:s', strtotime('-15 day'))."'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
          $m="Note: Your next registration will be done after 8 days. आपका अगला नया पंजीकरण 8 दिन बाद ही हो पाएगा।";
          $response = SendMessage($input['mobile_no'], $m);
          echo json_encode(array('status'=>false,'message'=>"Ticket Already Generated"));
        }else{
          $sql="INSERT INTO `tickets-a` (`token_no`, `name`, `quarter_type`, `quarter_no`, `complaint_for`, `mobile_no`) VALUES ('" . $tokenno . "','".$input['name']."','".$input['quarter_type']."','".$input['quarter_no']."','".$input['complaint_for']."','".$input['mobile_no']."')";
          $result = $conn->query($sql);
          $m="Reg no. ".$tokenno." Thanks for problem registration,an attempt will be made to resolve your issue as soon as possible. समस्या पंजीकरण के लिए धन्यवाद,जल्द से जल्द आपकी समस्या के समाधान का प्रयास किया जाएगा (team apnasudhir)";
          $response = SendMessage($input['mobile_no'], $m);
          echo json_encode(array('status'=>true,'message'=>"Ticket Raised Successfully! Complaint Id is ".$tokenno));
        }
  }elseif($input['method'] == 'raise_ticket_b'){
        $sql ='SELECT MAX(ticket_id) as ticket FROM `tickets-b`';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $ID = $row['ticket'];
          $ID = $ID+1;
        }else{
          $ID = '1';
        }
        $tokenno= 'WARD22-B-'.$ID;
        $sql1= "SELECT *  FROM `tickets-b` WHERE `token_no` LIKE '".$tokenno."' AND `datetime` > '".date('Y-m-d H:i:s', strtotime('-15 day'))."'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
          echo json_encode(array('status'=>false,'message'=>"Ticket Already Generated"));
        }else{
          $sql="INSERT INTO `tickets-b` (`token_no`, `name`, `quarter_type`, `quarter_no`, `complaint_for`, `mobile_no`) VALUES ('" . $tokenno . "','".$input['name']."','".$input['quarter_type']."','".$input['quarter_no']."','".$input['complaint_for']."','".$input['mobile_no']."')";
          $result = $conn->query($sql);
          $m="Reg no. ".$tokenno." Thanks for problem registration,an attempt will be made to resolve your issue as soon as possible. समस्या पंजीकरण के लिए धन्यवाद,जल्द से जल्द आपकी समस्या के समाधान का प्रयास किया जाएगा (team apnasudhir)";
          $response = SendMessage($input['mobile_no'], $m);
          echo json_encode(array('status'=>true,'message'=>"Ticket Raised Successfully! Complaint Id is ".$tokenno));
        }
  }elseif($input['method'] == 'update_status'){
    if($input['var']=='A'){
      if($input['status']=='Approved'){
        $m="Resolve: आपकी समस्या का समाधान पूरा हुआ| Your Problem is solved (team:apnasudhir)";
        $response = SendMessage($input['phone'], $m);
      }elseif($input['status']=='Denied'){
        $m="Deny: क्षमा करे!अपरिहार्य कारणों से यह सेवा कुछ समय के लिए उपलब्ध नहीं है। Sorry! This service is not available for some time due to unavoidable reasons(team:apnasudhir)";
        $response = SendMessage($input['phone'], $m);
      }
      $sql="UPDATE `tickets-a` SET `status` = '".$input['status']."' WHERE `tickets-a`.`ticket_id` = '".$input['id']."'";
      $result = $conn->query($sql);
      if($result){
        echo json_encode(array('status'=>true,'message'=>"Status Updated Successfully"));
      }
    }else{
      if($input['status']=='Approved'){
        $m="Resolve: आपकी समस्या का समाधान पूरा हुआ| Your Problem is solved (team:apnasudhir)";
        $response = SendMessage($input['phone'], $m);
      }elseif($input['status']=='Denied'){
        $m="Deny: क्षमा करे!अपरिहार्य कारणों से यह सेवा कुछ समय के लिए उपलब्ध नहीं है। Sorry! This service is not available for some time due to unavoidable reasons(team:apnasudhir)";
        $response = SendMessage($input['phone'], $m);
      }
      $sql="UPDATE `tickets-b` SET `status` = '".$input['status']."' WHERE `tickets-b`.`ticket_id` = '".$input['id']."'";
      $result = $conn->query($sql);
      if($result){
        echo json_encode(array('status'=>true,'message'=>"Status Updated Successfully"));
      }
    }
  }elseif($input['method'] == 'add_work'){
    $sql="INSERT INTO `work_done` (`work_name`, `work_details`, `done_on`) VALUES ('".$input['name']."','".$input['description']."','".$input['datee']."')";
    $result = $conn->query($sql);
    // $m="Thank you for complaning your complaint no is ".$tokenno;
    // $response = SendMessage($input['mobile_no'], $m);
    echo json_encode(array('status'=>true,'message'=>"Work Added Successfully!"));
  }elseif($input['method'] == 'check_status'){
    $token = explode('-', $input['token']);
    $section = $token[1];
    if($section =="A"){
      $sql1= "SELECT *  FROM `tickets-a` WHERE `token_no` LIKE '".$input['token']."'";
      $result = $conn->query($sql1);
    }else{
      $sql1= "SELECT *  FROM `tickets-b` WHERE `token_no` LIKE '".$input['token']."'";
      $result = $conn->query($sql1);
    }
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $ID = $row['status'];
      echo json_encode(array('status'=>$ID));
    }else{
      echo json_encode(array('status'=>'Undefined'));
    }

  }

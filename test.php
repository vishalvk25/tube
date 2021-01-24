<?php
// $phone ='+91124454545';
//  print_r(explode('+91', $phone));
// die();
include_once('podrones-podbanks/common/dbconn.php');
$api_key = "004e6285aa42d55d6c79f1bbc116b9d059f3c4c39488f16c";
$api_token = "1d5145c211083b449182ba0d83284d630fa631ba094df820";
$exotel_sid = "podrones";
$data = array();
$url = "https://".$api_key.":".$api_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Calls.json?Status=completed&Direction=outbound-api&pretty";
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);

$result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
curl_close($ch);
$calls = json_decode($result,TRUE);
$calls = $calls['Calls'];
//echo json_encode($calls); die();
foreach ($calls as $key => $row) {
	if($row['RecordingUrl']!=""){
		echo $row['RecordingUrl'];
		continue;die();
	}else{
		continue;die();
	}
		if($row['Price']=='0' && $row['RecordingUrl']=="" && $row['DateCreated'] > date('Y-m-d 00:00:00',strtotime("-1 days"))){
			$phone = substr($row['From'], -10);
			$sel = "SELECT * FROM `customers` WHERE `Phone` = :Phone";
			$stmtsel = $pdo->prepare($sel);
			$resultsel = $stmtsel->execute(['Phone'=>$phone]);
			if ($stmtsel->rowCount() >  0) {
				$cust = $stmtsel->fetch();
				$sel1 = "SELECT *  FROM `customercontact` WHERE `CustomerID` = :CustomerID AND `data_action` LIKE 'Incoming Missed Call' AND `data_values` = :data_values";
				$stmtsel1 = $pdo->prepare($sel1);
				$resultsel1 = $stmtsel1->execute(['CustomerID'=>$cust['CustomerID'],'data_values'=>$row['StartTime']]);
				if ($stmtsel1->rowCount() == 0) {
					$today_date=date('Y-m-d H:i:s');
					$sql = "INSERT INTO customercontact (`CustomerID`, `EventDateTime`, `ContactType`, `data_action`, `data_values`, `user_id`) ";
					$sql .= "VALUES(:custId,:today_date,'phone',:data_option,:data_value,:user_id)";
					$stmt = $pdo->prepare($sql);
					$result = $stmt->execute(['custId' => $cust['CustomerID'], 'today_date' => $today_date,'user_id' => '0', 'data_option' => 'Incoming Missed Call', 'data_value' => $row['StartTime']]);
					if ($result) {
							echo json_encode(array('status'=>true,'message'=>"Remark Added Successfully..."));
					}
				}
			}
		}
}
//print_r($calls);

die();
include_once('podrones-podbanks/common/dbconn.php');

function get_dp_info($dpname,$username,$password,$flag){
	global $pdo;
	$str = $username.":".$password;
	$encode = base64_encode($str);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://locus-api.com/v1/client/".$clientId."/user/".$dpname,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "{}",
		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
		CURLOPT_USERPWD => $username.":".$password,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_HTTPHEADER => array(
			"authorization: Basic ".$encode
		),
	));
	$responseuser = curl_exec($curl);
	$erruser = curl_error($curl);
	curl_close($curl);
	if ($erruser) {
		echo "cURL Error #:" . $erruser;
	} else {
		$arrayuser = json_decode($responseuser, true );
		$userid = $arrayuser['userId'];
		$phone = $arrayuser['phone'];
		$expph = explode('+91', $phone);
		$phone = $expph[1];
		$sqluser = "SELECT * FROM `customers` WHERE `Phone`= :phone";
		$stmtuser = $pdo->prepare($sqluser);
		$stmtuser->bindParam(':phone', $phone);
		$stmtuser->execute();
		$numuser = $stmtuser->rowCount();
		if ($numuser >  0) {
			$Recrow = $stmtuser->fetch(PDO::FETCH_ASSOC);
			$customerId = $Recrow["CustomerID"];
			if($flag=='0'){
				return $customerId;
			}else{
				return $phone;
			}
		}
		else{
			return '';
		}
	}
}
die();
$PackageID ='5315';
$UserType = "Consignee";
$DPP = '9503692037';
$CustID = '214';
if(isset($PackageID) && ($UserType == "Deliverer")){
	$sqlUpdPackage = "UPDATE `packages` SET `CustID` = '$CustID', `CustomerPhone` = '$DPP' ";
	$sqlUpdPackage .= "WHERE `packages`.`PackageID` = '" . $PackageID . "'";
	$conn->query($sqlUpdPackage);
}elseif(isset($PackageID) && ($UserType == "Consignee")){
	$sql = "SELECT * FROM `packages` WHERE `PackageID` = '" . $PackageID . "' AND `PackageStatus` = 'RTO'" ;
	$result = $conn->query($sql);
	if ($result && $result->num_rows > 0) {
		$sqlUpdPackage = "UPDATE `packages` SET `CustID` = '$CustID', `CustomerPhone` = '$DPP' ";
		$sqlUpdPackage .= "WHERE `packages`.`PackageID` = '" . $PackageID . "'";
		$conn->query($sqlUpdPackage);
	}
}
echo "sadfasfas";
          die();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://staging.podrones.com/api/LD/task_callback.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

die();
$string = '12-2-'.date('Y-m-d H:i:s');
//$string = 'amtvOThyUjl5MHdUVm12US9hbDg0Zz09';
$encrypt_method = "AES-256-CBC";
   $secret_key = 'XaviourisXmen';
   $secret_iv = 'ReallyHeis';
   // hash
   $key = hash('sha256', $secret_key);

   // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
   $iv = substr(hash('sha256', $secret_iv), 0, 16);
  // if ( $action == 'encrypt' ) {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = '-'.base64_encode($output).'-';

  // } else if( $action == 'decrypt' ) {
    //   $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
echo $output; ?>
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $output;?>&choe=UTF-8" title="Link to Google.com" />
<?php

die();
$api_key = "004e6285aa42d55d6c79f1bbc116b9d059f3c4c39488f16c";
$api_token = "1d5145c211083b449182ba0d83284d630fa631ba094df820";
$exotel_sid = "podrones";
$data = array();
$url = "https://".$api_key.":".$api_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Calls.json?Status=no-answer,completed&Direction=inbound&pretty";
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST,0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);

$result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
curl_close($ch);
print_r($result);
die();
?>

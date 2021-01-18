<?php
session_start();
require_once("connection/connt.php");

if($_POST["action"] == "image_upload"){
    // Check if file was uploaded without errors
    if(!isset($_POST["medianame"])){
        $_POST["medianame"] ='m';
    }elseif ($_POST["medianame"]=='') {
        $_POST["medianame"] ='m';
    }
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
       //  print_r($_FILES);
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["file"]["name"];
        //$filename = "mayurbhegade.png";
        $filetype = $_FILES["file"]["type"];
        $filesize = $_FILES["file"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) {
         echo  json_encode(array('status'=>FALSE,'status_code'=>"1",'message'=> "File size is larger than the allowed limit."));
         die();
        }
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("Uploads/" . $filename)){
                echo json_encode(array('status'=>FALSE,'status_code'=>"1",'message'=>$filename . " is already exists."));
            } else{
                $fileArr = explode('.',$filename);
                $filename = $_POST["medianame"].'-'.date("d-m-Y-H-i-s").'.'.$fileArr[1];
                move_uploaded_file($_FILES["file"]["tmp_name"], "Uploads/" . $filename);
                 echo json_encode(array('status'=>TRUE,'status_code'=>"1",'message'=> $filename));
             }
        } else{
          echo json_encode(array('status'=>FALSE,'status_code'=>"2",'message'=>"ERROR(2):FALIED TO ADD"));
        }
    } else{
      echo json_encode(array('status'=>FALSE,'status_code'=>"2",'message'=> $_FILES["file"]["error"]));
    }
}

?>

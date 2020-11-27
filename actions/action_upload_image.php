<?php

session_start();

if (!isset($_SESSION['email']))
  die(header('Location: ./login.php'));

// uploading files on submit
if(isset($_POST['submit'])){ 

  // uploading files
  $msg= upload_file('pet-image[]');
  $_SESSION['messages'][] = $msg;
  header('location:../pages/new-pet.php');
}

function upload_file() {

  $uploadTo = "../images/";
  $allowFileType = array('jpg','png','jpeg', 'JPG', 'PNG', 'JPEG');

  $total = count($_FILES['pet-image']['name']);

  $error = false;

  for( $i=0 ; $i < $total ; $i++ ) {
    $fileName = $_FILES['pet-image']['name'][$i];
    $tempPath = $_FILES['pet-image']["tmp_name"][$i];

    $basename = basename($fileName);
    $originalPath = $uploadTo.$basename;
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 

    if(!empty($fileName)) {
  
      if(in_array($fileType, $allowFileType)) {
        // Upload file to server
        if(move_uploaded_file($tempPath,$originalPath)) { 
          if (!$error) {
            $msg = array('type' => 'success', 'content' => $fileName.' was uploaded successfully');
          }
        }
        else{
          $msg = array('type' => 'error', 'content' => 'File '.$fileName.' not uploaded! Try again');
          $error = true;
        }
      }
      else {
        $msg = array('type' => 'error', 'content' => '.'.$fileType.' File type not allowed ('.$fileName.')');
        $error = true;
      }
    }
  }

  return $msg;
}

?>
<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to remove pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  try {
    $email = $_SESSION['email'];
    $pet_id = $_POST['pet_id'];

    if(!is_id($pet_id)){
      throw new Exception('Invalid Pet id');
    }

    if(getPetOwner($pet_id) == $email) {
      removePet($pet_id);

      $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Pet Removed!');
    }
    else{
      throw new PDOException('User Does Not Own This Pet');
    }
  }
  catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to remove pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }
  header("Location: ../../pages/profile.php");
?>
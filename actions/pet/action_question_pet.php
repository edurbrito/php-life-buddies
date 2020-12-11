<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = $_POST['csrf'];
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add question to pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  $email = $_SESSION['email'];

  $pet = $_POST['pet_id'];
  $question = clean_text($_POST['question']);

  try {

    if(!is_id($pet)){
      throw new Exception('Invalid Pet id');
    }

    addPetQuestion($email, $pet, $question);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added Question to Pet!');
  } catch (Exception $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add question to pet!');
  }
  header("Location: ../../pages/pet.php?pet_id={$pet}");
?>
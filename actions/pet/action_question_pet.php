<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add question to pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  try {

    $email = $_SESSION['email'];

    $question = clean_text($_POST['question']);
    $pet_id = $_POST['pet_id'];

    if(!is_id($pet_id)){
      throw new Exception('Invalid Pet id');
    }

    addPetQuestion($email, $pet_id, $question);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added Question to Pet!');

  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add question to pet!');
  }
  header("Location: ../../pages/pet.php?pet_id={$pet_id}");
?>
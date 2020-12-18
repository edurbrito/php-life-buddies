<?php

include_once('../../includes/session.php');
include_once('../../database/db_pet.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  try {
    $csrf = isset($_GET['token']) ? $_GET['token'] : NULL;

    if ($csrf != $_SESSION['csrf'])
      throw new Exception("Wrong token");

    $email = isset($_GET['email']) ? $_GET['email'] : NULL;

    if(!isset($_SESSION['email']) || $email != $_SESSION['email'])
      throw new Exception("Wrong email");

    $pet_id = isset($_GET['pet_id']) ? $_GET['pet_id'] : NULL;
    
    if(!is_id($pet_id)){
      throw new Exception('Invalid Pet id');
    }

    $pet = getPetInfo($pet_id);
    
    if(getPetOwner($pet_id) == $email || $pet['adoptedBy'] != NULL){
        throw new Exception('Cannot add proposal');
    }

    addPetAdoptionProposal($email, $pet_id);

    die('{"type": "success", "action": "Added Proposal!" }');

  } catch (Exception $e) {
    http_response_code(403);
  }
} else {
  http_response_code(404);
}
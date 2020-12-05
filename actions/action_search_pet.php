<?php
  include_once('../includes/session.php');
  include_once('../database/db_pet.php');

  $csrf = $_GET['csrf'];
  if($csrf != $_SESSION['csrf'])
    die("{}");

  $matchType = clean_text($_GET['match_type']) == "on" ? 1 : 0;
  $name = clean_text($_GET['name']);
  $species = clean_text($_GET['species']);
  $age = clean_text($_GET['age']);
  $color = clean_text($_GET['color']);
  $location = clean_text($_GET['location']);

  try {

    if($name == NULL && $species == NULL && $age == NULL && $color == NULL && $location == NULL)
      die(json_encode(getAllPets()));

    $pets = searchPets($matchType, $name, $species, $age, $color, $location);

    if($pets == NULL || count($pets) == 0)
      throw new PDOException("No pet found");
    
    die(json_encode($pets));

  } catch (Exception $e) {
    // die($e->getMessage());
    echo "{}";
  }
  
?>
<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = $_GET['csrf'];
  if($csrf != $_SESSION['csrf'])
    die("{}");

  $matchType = $name = $species = $age = $color = $location = NULL;
  
  if(isset($_GET['match_type']))
    $matchType = clean_text($_GET['match_type']) == "on" ? 1 : 0;
  else
    $matchType = 0;
    
  if(isset($_GET['name']))
    $name = clean_text($_GET['name']);
  if(isset($_GET['species']))
    $species = clean_text($_GET['species']);
  if(isset($_GET['age']))
    $age = clean_text($_GET['age']);
  if(isset($_GET['color']))
    $color = clean_text($_GET['color']);
  if(isset($_GET['location']))
    $location = clean_text($_GET['location']);

  try {

    if($name == NULL && $species == NULL && $age == NULL && $color == NULL && $location == NULL)
      die(json_encode(getAllPets()));

    $pets = searchPets($matchType, $name, $species, $age, $color, $location);

    if($pets == NULL || count($pets) == 0)
      throw new PDOException("No pet found");
    
    die(json_encode($pets));

  } catch (Exception $e) {
    echo "{}";
  }
  
?>
<?php
  include_once(dirname(__DIR__) . '/includes/database.php');
  include_once(dirname(__DIR__) . '/includes/regex.php');

  function insertPet($name, $species, $age, $color, $location, $user) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO Pet(name, species, age, color, location, user) VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($name, $species, $age, $color, $location, $user));

    $stmt = $db->prepare('SELECT * FROM Pet ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $pet = $stmt->fetch();
    return $pet;
  }

  function removePet($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('DELETE FROM Pet WHERE id=?');
    $stmt->execute(array($pet_id));
  }

  function updatePet($pet_id, $name, $species, $age, $color, $location, $user) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE Pet SET name = ?, species = ?, age = ?, color = ?, location = ? WHERE id = ? AND user = ?');
    $stmt->execute(array($name, $species, $age, $color, $location, $pet_id, $user));
  }

  function getPetInfo($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $pet = $stmt->fetch();
    return $pet;
  }

  function getPetOwner($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT user FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $pet = $stmt->fetch();
    return $pet['user'];
  }

  function getPetAdopter($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT adoptedBy FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $pet = $stmt->fetch();
    return $pet['adoptedBy'];
  }

  function addPetPhoto($user, $pet_info, $photo){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT user, adoptedBy FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_info["id"]));

    $users = $stmt->fetch();

    if($user != $users['user'] && $user != $users['adoptedBy'])
      throw new PDOException();

    $stmt = $db->prepare('INSERT INTO Photo VALUES(?, ?)');
    $stmt->execute(array($pet_info["id"], $photo));
  }

  function addAllPetPhotos($user, $pet_info) {
    $uploadTo = "../images/";
    $allowFileType = array('jpg','png','jpeg', 'JPG', 'PNG', 'JPEG');

    $total = count($_FILES['pet-image']['name']);

    if ($total === 1 && !$_FILES['pet-image']['name'][0]) {
      return -1;
    }

    $error = false;

    for( $i=0 ; $i < $total ; $i++ ) {
      $fileName = $_FILES['pet-image']['name'][$i];
      $tempPath = $_FILES['pet-image']["tmp_name"][$i];

      $basename = basename($fileName);
      $originalPath = $uploadTo.$basename;
      $fileType = pathinfo($originalPath, PATHINFO_EXTENSION);

      if(!empty($fileName)) {
  
        if(in_array($fileType, $allowFileType)) {
          if (!$error) {
            $msg = array('type' => 'success', 'content' => $fileName.' was uploaded successfully');
          }
        }
        else {
          $msg = array('type' => 'error', 'content' => '.'.$fileType.' File type not allowed ('.$fileName.')');
          $error = true;
        }
      }

      $_SESSION['messages'][] = $msg;

      // Upload file to server
      try {
        if(move_uploaded_file($tempPath, "../" . $originalPath) != false)
          addPetPhoto($user, $pet_info, $originalPath);
        else
          $msg = array('type' => 'error', 'content' => '.'.$fileType.' File type not allowed ('.$fileName.')');
      }
      catch(Exception $e) {
        continue;
      }
    }

    $_SESSION['messages'][] = $msg;
  }

  function isPetFavorite($pet_id, $user) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Favorite WHERE user = ? AND pet_id = ? ');
    $stmt->execute(array($user, $pet_id));
    
    $pet = $stmt->fetch();
    return $pet != NULL;
  }

  function addPetToFavorites($user, $pet_id){
    $db = Database::instance()->db();
    try {
      $stmt = $db->prepare('INSERT INTO Favorite VALUES(?, ?)');
      $stmt->execute(array($user, $pet_id));
      notifyUser($pet_id, $user, " added to their favorites' list the pet ");
      return 'added';
    } catch (Exception $e) {
      $stmt = $db->prepare('DELETE FROM Favorite WHERE user = ? AND pet_id = ?');
      $stmt->execute(array($user, $pet_id));
      notifyUser($pet_id, $user, " removed from their favorites' list the pet ");
      return 'removed';
    }
  }

  function addPetQuestion($user, $pet_id, $question){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO Question(user, pet_id, question) VALUES(?, ?, ?)');
    $stmt->execute(array($user, $pet_id, $question));

    notifyUser($pet_id, $user, " asked something about the pet ");
  }

  function addPetAdoptionProposal($user, $pet_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO AdoptionProposal(user,pet_id) VALUES(?, ?)');
    $stmt->execute(array($user, $pet_id));

    notifyUser($pet_id, $user, " made a proposal to the pet ");
  }

  function setPetAdoptState($user, $pet_id, $state){
    $db = Database::instance()->db();
    if($state == 1){
      $stmt = $db->prepare('UPDATE Pet SET adoptedBy = ? WHERE id = ?');
      $stmt->execute(array($user, $pet_id));
      $stmt = $db->prepare('UPDATE AdoptionProposal SET state = ? WHERE pet_id = ? AND user = ? ');
      $stmt->execute(array($state, $pet_id, $user));
    }
    else if($state == -1 || $state == 0){
      $stmt = $db->prepare('UPDATE AdoptionProposal SET state = ? WHERE pet_id = ? AND user = ? ');
      $stmt->execute(array($state, $pet_id, $user));
    }
  }

  function getPetProposals($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT U.email, U.name, A_S.string AS state FROM User AS U, AdoptionProposal AS A, AdoptState AS A_S WHERE U.email = A.user AND A.state = A_S.id AND A.pet_id = ?');
    $stmt->execute(array($pet_id));

    $proposals = $stmt->fetchAll();
    return $proposals;
  }

  function getPetQuestions($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT U.email, U.name, Q.question FROM User AS U, Question AS Q WHERE U.email = Q.user AND Q.pet_id = ?');
    $stmt->execute(array($pet_id));

    $questions = $stmt->fetchAll();
    return $questions;
  }

  function getPetPhotos($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT photo FROM Photo WHERE pet_id = ?');
    $stmt->execute(array($pet_id));

    $photos = $stmt->fetchAll();
    return $photos;
  }

  function getAllPets(){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, Photo WHERE id = pet_id GROUP BY id;');
    $stmt->execute();

    return $stmt->fetchAll();
  }

  function searchPets($matchType, $name, $species, $age, $color, $location){
    $attributes = array();
    if($matchType == 0){
      $match = "%' AND ";
    }
    else if($matchType == 1){
      $match = "%' OR ";
    }

    foreach (array(["name", $name], ["species", $species], ["age", $age], ["color", $color], ["location", $location]) as $attr) {
      if($attr[1] != NULL && $attr[1] != ""){
          array_push($attributes, $attr[0] . " LIKE '%" . $attr[1] . $match); 
      }
    }

    $index = count( $attributes ) - 1;
    if($index >= 0)
    {
      $value = $attributes[$index];
      $attributes[$index] = str_replace($match, "%') GROUP BY id;", $value);
      $query = 'SELECT DISTINCT id, name, age, color, species, location, photo, user, adoptedBy FROM Pet, Photo WHERE id = pet_id AND (' . implode("",$attributes);

      $db = Database::instance()->db();
      $stmt = $db->prepare($query);
      $stmt->execute();
  
      return $stmt->fetchAll();
    }

    return NULL;
  }

  function notifyUser($pet_id, $notifier, $string){
    $db = Database::instance()->db();
    $pet = getPetInfo($pet_id);
    try{
      if($notifier == $pet['user'])
        throw new Exception();

      $stmt = $db->prepare('SELECT name FROM User WHERE email = ?;');
      $stmt->execute(array($notifier));
      $notifier_name = $stmt->fetch()['name'];

      $stmt = $db->prepare('INSERT INTO UserNotification VALUES(?,?,?,?);');
      $stmt->execute(array($pet['user'], $notifier_name . ' ' . $string . $pet['name'], $notifier, $pet_id));
    }
    catch(Exception $e){
    }
  }

  function getSpecies($specie) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare("SELECT DISTINCT species FROM Pet WHERE upper(species) LIKE upper(?) LIMIT 5");
    $stmt->execute(array("$specie%"));
    $species = $stmt->fetchAll();

    return $species;
  }

  function getNames($name) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare("SELECT DISTINCT name FROM Pet WHERE upper(name) LIKE upper(?) LIMIT 5");
    $stmt->execute(array("$name%"));
    $names = $stmt->fetchAll();

    return $names;
  }

  function getAges($age) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare("SELECT DISTINCT age FROM Pet WHERE upper(age) LIKE upper(?) LIMIT 5");
    $stmt->execute(array("$age%"));
    $ages = $stmt->fetchAll();

    return $ages;
  }

  function getColors($color) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare("SELECT DISTINCT color FROM Pet WHERE upper(color) LIKE upper(?) LIMIT 5");
    $stmt->execute(array("$color%"));
    $colors = $stmt->fetchAll();

    return $colors;
  }

  function getLocations($location) {
    $db = Database::instance()->db();
    
    $stmt = $db->prepare("SELECT DISTINCT location FROM Pet WHERE upper(location) LIKE upper(?) LIMIT 5");
    $stmt->execute(array("$location%"));
    $locations = $stmt->fetchAll();

    return $locations;
  }
?>
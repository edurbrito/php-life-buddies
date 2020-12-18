<?php
    include_once('../../database/db_pet.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        die(json_encode(getAllPets()));
    }
    else{
        http_response_code(404);
    }
?>
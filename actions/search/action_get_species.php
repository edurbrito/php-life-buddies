<?php
    include_once('../../database/db_pet.php');

    if(isset($_GET['specie']))
        $specie = $_GET['specie'];

    $species = getSpecies($specie);

    die(json_encode($species));
?>
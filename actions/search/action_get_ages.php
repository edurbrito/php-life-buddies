<?php
    include_once('../../database/db_pet.php');

    if(isset($_GET['age']))
        $age = $_GET['age'];

    $ages = getAges($age);

    die(json_encode($ages));
?>
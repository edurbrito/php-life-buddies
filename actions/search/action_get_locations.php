<?php
    include_once('../../database/db_pet.php');

    if(isset($_GET['location']))
        $location = $_GET['location'];

    $locations = getLocations($location);

    die(json_encode($locations));
?>
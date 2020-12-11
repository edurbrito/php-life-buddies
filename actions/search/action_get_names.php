<?php
    include_once('../../database/db_pet.php');

    if(isset($_GET['name']))
        $name = $_GET['name'];

    $names = getNames($name);

    die(json_encode($names));
?>
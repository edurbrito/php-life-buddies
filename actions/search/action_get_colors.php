<?php
    include_once('../../database/db_pet.php');

    if(isset($_GET['color']))
        $color = $_GET['color'];

    $colors = getColors($color);

    die(json_encode($colors));
?>
<?php
    include_once('../../database/db_user.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        die(json_encode(getAllUsers()));
    }
    else{
        http_response_code(404);
    }
?>
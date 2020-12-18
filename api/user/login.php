<?php

include_once('../../includes/session.php');
include_once('../../database/db_user.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $email = isset($_GET['email']) ? $_GET['email'] : NULL;
    $password = isset($_GET['password']) ? $_GET['password'] : NULL;

    if (checkUserPassword($email, $password) && validate_user("SomeName", $email, "912345678", $password)) {
        $user = getUserInfo($email);
        $user['token'] = $_SESSION['csrf'];
        $_SESSION['email'] = $email;
        die(json_encode($user));
    }
    else {
        http_response_code(403);
    }
} else {
    http_response_code(404);
}

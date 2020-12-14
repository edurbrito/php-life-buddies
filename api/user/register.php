<?php

include_once('../../includes/session.php');
include_once('../../database/db_user.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = isset($_GET['email']) ? $_GET['email'] : NULL;
    $password = isset($_GET['password']) ? $_GET['password'] : NULL;
    $name = isset($_GET['name']) ? $_GET['name'] : NULL;
    $phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : NULL;

    try {
        if(!validate_user($name, $email, $phone_number, $password)){
          throw new Exception("Matching errors in one of the inputs");
        }
    
        insertUser($email, $password, $name, $phone_number);
        $user = getUserInfo($email);
        $user['token'] = $_SESSION['csrf'];
        $_SESSION['email'] = $email;
        die(json_encode($user));

      } catch (Exception $e) {
        http_response_code(403);
    }
} else {
    http_response_code(404);
}

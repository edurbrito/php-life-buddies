<?php
    include_once('../../database/db_user.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $matchType = $email = $name = $phone_number = NULL;
  
        if(isset($_GET['match_type']))
            $matchType = clean_text($_GET['match_type']) == "on" ? 1 : 0;
        else
            $matchType = 0;
            
        if(isset($_GET['email']))
            $email = clean_text($_GET['email']);
        if(isset($_GET['name']))
            $name = clean_text($_GET['name']);
        if(isset($_GET['phone_number']))
            $phone_number = clean_text($_GET['phone_number']);

        try {

            if($email == NULL && $name == NULL && $phone_number == NULL)
                die(json_encode(getAllUsers()));

            $users = searchUsers($matchType, $email, $name, $phone_number);

            if($users == NULL || count($users) == 0)
                throw new PDOException("No user found");
            
            die(json_encode($users));

        } catch (Exception $e) {
            echo "{}";
        }
    }
    else{
        http_response_code(404);
    }

<?php

  function clean_text($old_text) {
    return preg_replace('/[^\w\d\s\.!,\?]/', '', $old_text);
  }

  function is_name($name){
    return preg_match("/^[a-zA-Z-'À-ú ]+$/", $name);
  }

  function is_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function is_phone_number($phone_number) {
    return preg_match("/^\d{9}|\d{3}-\d{3}-\d{3}$/", $phone_number);
  }

  /**
   * Password needs to match:
   * ^: anchored to beginning of string
   * \S*: any set of characters
   * (?=\S{8,}): of at least length 8
   * (?=\S*[a-z]): containing at least one lowercase letter
   * (?=\S*[A-Z]): and at least one uppercase letter
   * (?=\S*[\d]): and at least one number
   * $: anchored to the end of the string
  */
  function is_password($password){
    return preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password);
  }

  function validate_user($name, $email, $phone_number, $password){
    return is_name($name) && is_email($email) && is_phone_number($phone_number) && is_password($password);
  }

  function is_id($id){
    return preg_match("/^\d+$/", $id);
  }

  function is_alphanumeric($name){
    return preg_match("/^[a-zA-ZÀ-ú\d' ]+$/", $name);
  }

  function validate_pet($name, $species, $age, $color, $location){
    return is_name($name) && is_name($species) && is_name($color) && is_alphanumeric($age) && is_alphanumeric($location);
  }
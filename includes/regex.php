<?php

  /**
   * Removes not allowed characters
  */
  function clean_text($old_text) {
    return preg_replace('/[^À-ú\w\d\s\.!,\?]/', '', $old_text);
  }

  /**
   * Name needs to contain only letters and/or spaces
  */
  function is_name($name){
    return preg_match("/^[a-zA-Z-'À-ú ]+$/", $name);
  }

  /**
   * Valid email as verified by php
   * built in function 
  */
  function is_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  /**
   * Phone needs to match:
   * 9 digits number
   * or
   * DDD-DDD-DDD
  */
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

  /**
   * Id needs to be a number
  */
  function is_id($id){
    return preg_match("/^\d+$/", $id);
  }

  /**
   * Alphanumeric values contain
   * letters and/or numbers
  */
  function is_alphanumeric($name){
    return preg_match("/^[a-zA-ZÀ-ú\d' ]+$/", $name);
  }
  
  function invalid_pet($name, $species, $age, $color, $location) {
    if (!is_name($name)) {
      return "Invalid Pet Name!";
    }
    else if (!is_name($species)) {
      return "Invalid Species!";
    }
    else if (!is_name($color)) {
      return "Invalid Color!";
    }
    else if (!is_alphanumeric($age)) {
      return "Invalid Age!";
    }
    else if (!is_alphanumeric($location)) {
      return "Invalid Location!";
    }

    return "";
  }
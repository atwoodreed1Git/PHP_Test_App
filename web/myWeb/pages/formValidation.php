<?php 

// modified for my own use
function test_input($data, $regExpress) {
  $data = strip_tags($data);
  $data = ereg_replace($regExpress, "", $data);

  // from https://www.w3schools.com/php/php_form_validation.asp
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
}

// modified for my own use
function test_input1($data) {
  $data = strip_tags($data);

  // from https://www.w3schools.com/php/php_form_validation.asp
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
}

?>
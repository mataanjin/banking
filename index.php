<?php

session_start();

$appId = 'jaiksd783';
$session = & $_SESSION[$appId];
$errorMsg = & $session['error'];

if(isset($_GET['logout'])){
  $session = NULL;
  die('You have been logged out.<meta http-equiv="refresh" content="2;url=index.php">');
}

$title = 'Online Banking';

include_once 'connection.php';

//if user login than $session['uid'] is filled by user id
if (!$session['uid']) {
  include 'login.php';
} else {
  $modul = filter_input(INPUT_GET, 'modul', FILTER_SANITIZE_STRING);
  
  $post = (object)filter_input_array(INPUT_POST);
  $get = (object)filter_input_array(INPUT_GET);
  
  //if module is selected then $session will not be empty.
  //if module is active it will point to a file
  if (file_exists('CLS_' . $modul . '.php')) {
    include 'CLS_' . $modul . '.php';
  } else {
    include 'CLS_main.php';
  }
}
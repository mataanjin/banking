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
  //if module is selected then $session will not be empty.
  //if module is active it will point to a file
  if (file_exists('CLS_' . $session['modul'] . '.php')) {
    include 'CLS_' . $session['modul'] . '.php';
  } else {
    include 'CLS_main.php';
  }
}
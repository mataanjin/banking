<?php

session_start();

$appId = 'jaiksd783';

include_once 'connection.php';

//if user login than $_SESSION[$appId]['uid'] is filled by user id
if (!$_SESSION[$appId]['uid']) {
  include 'login.php';
} else {
  //if module is selected then $_SESSION[$appId] will not be empty.
  //if module is active it will point to a file
  if (file_exists('CLS_' . $_SESSION[$appId]['modul'] . '.php')) {
    include 'CLS_' . $_SESSION[$appId]['modul'] . '.php';
  } else {
    include 'CLS_main.php';
  }
}
<?php

/* @var $dbh PDO */
$subtitle = $session['name'];

function inputValidation($post) {
  global $dbh, $session;
  
  //input validation
  if (empty($post->oPass)) {
    $error .= 'Old Password must be filled.';
  } else {
    $sql = 'SELECT `password` FROM `users` WHERE `id` = ?';
    $p_user = $dbh->prepare($sql);
    $p_user->execute([$session['uid']]);
    if ($p_user->rowCount()) {
      if (!password_verify($post->oPass, $p_user->fetch()->password)) {
        $error .= 'Old Password incorrect.';
      }
    }
  }
  if (empty($post->nPass)) {
    $error .= 'New Password must be filled.';
  }
  if (empty($post->nPass1)) {
    $error .= 'Confirm New Password must be filled.';
  }
  if ($post->nPass != $post->nPass1) {
    $error .= 'New Password and Confirm New Password didn\'t match.';
  }
  return $error;
}

if (isset($post->changePassword)) {
  $error = inputValidation($post);
  if (empty($error)) {
    $sql = 'UPDATE `users` SET `password` = ? WHERE `id` = ?';
    $p_users = $dbh->prepare($sql);
    if (
            $p_users->execute(
                    [
                        password_hash($post->nPass, PASSWORD_DEFAULT),
                        $session['uid']
                    ]
            )
    ) {
      $flash = 'Password succesfully changed'
              . '<meta http-equiv="refresh" content="2;url=index.php?modul=' . $modul . '">';
    } else {
      $error = 'ERROR: Cannot update database';
    }
  }
}


include 'VIEW_controlPanel.ctp';

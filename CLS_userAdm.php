<?php

/* @var $dbh PDO */
$subtitle = 'Teller';

$state = $post->state ? $post->state : '';

if($post->cancel){
  $state = '';
}

function inputValidation($post) {
  //input validation
  if (empty($post->name)) {
    $error.='Name must be filled.';
  }
  if (empty($post->email)) {
    $error.='Email must be filled.';
  }
  if (empty($post->phone)) {
    $error.='Phone must be filled.';
  }
  if (empty($post->address)) {
    $error.='Address must be filled.';
  }
  return $error;
}

if ($state) {
  if (isset($post->createUser)) {
    $error = inputValidation($post);
    if (empty($error)) {
      $pass = substr(password_hash(time(), PASSWORD_DEFAULT), 0, 10);
      $sql = 'INSERT INTO `users`(`ssn`, `name`, `address`, `phone`, `email`, `password`, `created`, `modified`) '
              . 'VALUES (?,?,?,?,?,?,NOW(), NOW())';
      $p_user = $dbh->prepare($sql);
      if (
              $p_user->execute([$post->ssn,
                  $post->name,
                  $post->address,
                  $post->phone,
                  $post->email,
                  password_hash($pass, PASSWORD_DEFAULT)])
      ) {
        $flash = 'User created. Password is <b>' . $pass . '</b>'
                . '<meta http-equiv="refresh" content="2;url=index.php?modul=' . $modul . '">';
      } else {
        $error = 'ERROR: User cannot be created. (Possible email duplicate)';
      }
    }
  } elseif (isset($post->editUser)) {
    $error = inputValidation($post);
    if (empty($error)) {
      $sql = 'UPDATE `users` SET `ssn`=?,`name`=?,`address`=?,`phone`=?,`email`=?,`modified`=NOW() '
              . 'WHERE `id` = ?';
      $p_user = $dbh->prepare($sql);
      if (
              $p_user->execute([$post->ssn,
                  $post->name,
                  $post->address,
                  $post->phone,
                  $post->email,
                  $post->id])
      ) {
        $flash = 'User has been updated.'
                . '<meta http-equiv="refresh" content="2;url=index.php?modul=' . $modul . '">';
      } else {
        $error = 'ERROR: User cannot be update. (Possible email duplicate)';
      }
    }
  } elseif (isset($post->reset)) {
    $pass = substr(password_hash(time(), PASSWORD_DEFAULT), 0, 10);
    $sql = 'UPDATE `users` SET `password` = ? WHERE `id` = ?';
    $p_user = $dbh->prepare($sql);
    if ($p_user->execute([password_hash($pass, PASSWORD_DEFAULT), $post->id])) {
      $flash = 'User passwrod is reseted. Password is <b>' . $pass . '</b>'
              . '<meta http-equiv="refresh" content="2;url=index.php?modul=' . $modul . '">';
    } else {
      $error = 'ERROR: User password cannot be reseted.';
    }
  }
} else {
  if (isset($post->newUser)) {
    $state = 'new';
  } elseif (isset($post->editUser)) {
    $state = 'edit';
    
    $sql = 'SELECT `ssn`, `name`, `address`, `phone`, `email` FROM `users` WHERE `id` = ?';
    $p_user = $dbh->prepare($sql);
    $p_user->execute([$post->editUser]);
    $user = $p_user->fetch();
    
    $_POST['id'] = $post->editUser;
    $_POST['ssn'] = $user->ssn;
    $_POST['name'] = $user->name;
    $_POST['address'] = $user->address;
    $_POST['phone'] = $user->phone;
    $_POST['email'] = $user->email;
  } elseif ($post->deleteUser) {
    $sql = 'DELETE FROM users WHERE id = ?';
    $p_user = $dbh->prepare($sql);
    if ($p_user->execute([$post->deleteUser])) {
      $flash = 'User has been deleted.';
    } else {
      $error = 'Error: User cannot be deleted.';
    }
  }

  $sql = 'SELECT `id`, `name`, `email`, `modified` FROM `users`';
  if (isset($post->searchUser)) {
    $sql .= ' WHERE name LIKE ? OR email LIKE ?';
    $users = $dbh->prepare($sql);
    $users->execute(['%' . $post->search . '%', '%' . $post->search . '%']);
  } else {
    $users = $dbh->query($sql);
  }
}

include 'VIEW_user_adm_' . ($state ? $state : 'main') . '.ctp';

<?php

/* @var $dbh PDO */
$subtitle = 'Teller';

$state = $post->state ? $post->state : '';

if ($post->cancel) {
  $state = '';
}

function inputValidation($post) {
  global $dbh;

  //input validation
  if (empty($post->user)) {
    $error.='Name must be filled.';
  } else {
    $sql = 'SELECT COUNT(*) `ct` FROM `users` WHERE `id` = ?';
    $p_users = $dbh->prepare($sql);
    $p_users->execute([$post->user]);
    if ($p_users->fetch()->ct === 0) {
      $error.='User can\'t be found.';
    }
  }
  if (!is_numeric($post->balance) || $post->balance < 0) {
    $error.='Email must be filled.';
  }
  return $error;
}

if ($state) {
  if (isset($post->createAcc)) {
    $error = inputValidation($post);
    if (empty($error)) {
      $accNum = date('Ymdhis') . substr('000000' . $post->user, -6);

      $dbh->beginTransaction();

      try {
        $sql = 'INSERT INTO `accounts`(`user_id`, `account_number`, `saldo`, `active`, `created`) '
                . 'VALUES (?, ?, 0, 1, NOW())';
        $p_accounts = $dbh->prepare($sql);
        $p_accounts->execute([$post->user, $accNum]);

        $accId = $dbh->lastInsertId();
        if ($post->balance > 0) {
          $sql = 'INSERT INTO `transactions`(`account_id`, `ammount`, `info`, `created`) '
                  . 'VALUES (?, ?, ?, NOW())';
          $p_trasactions = $dbh->prepare($sql);
          $p_trasactions->execute([$accId, $post->balance, 'Initial saving']);
        }

        $dbh->commit();
        $flash = 'Account created.'
                . '<meta http-equiv="refresh" content="2;url=index.php?modul=' . $modul . '">';
      } catch (PDOException $exc) {
        $dbh->rollBack();
        $error = 'ERROR: Can\t update database.';
      }
    }
  }
} else {
  if (isset($post->newAcc)) {
    $state = 'new';
  } elseif (isset($post->activeAcc)) {
    $sql = 'UPDATE `accounts` SET `active` = 1 WHERE `id` = ?';
    $p_accounts = $dbh->prepare($sql);
    if ($p_accounts->execute([$post->activeAcc])) {
      $flash = 'Account has been activated.';
    } else {
      $error = 'Error: Can\'t update database.';
    }
  } elseif (isset($post->freezeAcc)) {
    $sql = 'UPDATE `accounts` SET `active` = 0 WHERE `id` = ?';
    $p_accounts = $dbh->prepare($sql);
    if ($p_accounts->execute([$post->freezeAcc])) {
      $flash = 'Account has been froze.';
    } else {
      $error = 'Error: Can\'t update database.';
    }
  } elseif ($post->deleteAcc) {
    $sql = 'DELETE FROM `accounts` WHERE `id` = ?';
    $p_accoutns = $dbh->prepare($sql);
    if ($p_accoutns->execute([$post->deleteAcc])) {
      $flash = 'Account has been deleted.';
    } else {
      $error = 'Error: Can\'t update database.';
    }
  }

  $sql = 'SELECT `id`, `account_number`, `active`, `modified` FROM `accounts`';
  if (isset($post->searchAcc)) {
    $sql .= ' WHERE account_number LIKE ?';
    $accounts = $dbh->prepare($sql);
    $accounts->execute(['%' . $post->search . '%']);
  } else {
    $accounts = $dbh->query($sql);
  }
}

include 'VIEW_account' . ucfirst($state ? $state : 'main') . '.ctp';

<?php
/* @var $dbh PDO */

if (isset($_POST['login'])) {
  $inputs = filter_input_array(INPUT_POST);

  $sql = 'SELECT id, password, name FROM users WHERE email = ?';
  $p_user = $dbh->prepare($sql);
  $p_user->execute([$inputs['email']]);
  if ($p_user->rowCount()) {
    $user = $p_user->fetch();
    if (password_verify($inputs['password'], $user['password'])) {
      $_SESSION[$appId]['uid'] = $user['id'];
      $_SESSION[$appId]['name'] = $user['name'];
      
      $sql = 'SELECT DISTINCT(role) role FROM user_roles WHERE user_id = ?';
      $p_userRoles = $dbh->prepare($sql);
      $p_userRoles->execute([$user['id']]);
      $_SESSION[$appId]['roles'] = $p_userRoles->fetchAll(PDO::FETCH_NUM);
      
      die('Logged.<meta http-equiv="refresh" content="2;url=index.php">');
    } else {
      $_SESSION[$appId]['error']['login'] = 'Email or password does not matched.';
    }
  } else {
    $_SESSION[$appId]['error']['login'] = 'Email or password does not matched.';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Banking Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <form method="post">
      <fieldset>
        <legend>Login</legend>
        <div class="errorMsg"><p><?= $_SESSION[$appId]['error']['login']; ?></p></div>
        <label><span>Email</span>:<input type="email" name="email" value="<?= $_POST['email']; ?>" placeholder="Email"></label><br>
        <label><span>Password</span>:<input type="password" name="password"></label><br>
        <button type="submit" name="login">OK</button>
      </fieldset>
    </form>
  </body>
</html>

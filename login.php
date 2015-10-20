<?php
/* @var $dbh PDO */

if (isset($_POST['login'])) {
  $inputs = (object) filter_input_array(INPUT_POST);

  $sql = 'SELECT id, password, name FROM users WHERE email = ?';
  $p_user = $dbh->prepare($sql);
  $p_user->execute([$inputs->email]);
  if ($p_user->rowCount()) {
    $user = $p_user->fetch();
    if (password_verify($inputs->password, $user->password)) {
      $session['uid'] = $user->id;
      $session['name'] = $user->name;

      $sql = 'SELECT DISTINCT(role) role FROM user_roles WHERE user_id = ?';
      $p_userRoles = $dbh->prepare($sql);
      $p_userRoles->execute([$user->id]);
      $session['roles'] = $p_userRoles->fetchAll(PDO::FETCH_NUM);

      die('Logged.<meta http-equiv="refresh" content="2;url=index.php">');
    } else {
      $errorMsg['login'] = 'Email or password does not matched.';
    }
  } else {
    $errorMsg['login'] = 'Email or password does not matched.';
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3.css">
  </head>

  <body>

    <header class="w3-container w3-teal">
      <h1><?= $title; ?></h1>
    </header>

    <div class="w3-quarter">&nbsp;</div>
    
    <div class="w3-container w3-half w3-margin-top">

      <form class="w3-container w3-card-4" method="post">
        <h2 class="w3-text-theme">Login</h2>
        <div class="w3-group">      
          <input class="w3-input" type="email" name="email" id="email" value="<?= $_POST['email']; ?>" required>
          <label for="email">Email</label>
        </div>
        <div class="w3-group">      
          <input class="w3-input" type="password" name="password" id="password" required>
          <label for="password">Password</label>
        </div>

        <br><br>
        <button class="w3-btn w3-theme" type="submit" name="login"> Log in </button>
        <br><br>
      </form>

      <?php if ($errorMsg['login']) : ?>
        <div class="w3-container w3-red">
          <p><?= $errorMsg['login']; ?></p>
        </div>
      <?php endif; ?>

    </div>

  </body>
</html> 
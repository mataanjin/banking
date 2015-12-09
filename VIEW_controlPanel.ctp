<?php include 'VIEW_header.php'; ?>
<?php if ($flash) : ?>
  <div class="w3-container w3-light-blue">
    <p><?= $flash; ?></p>
  </div>
<?php endif; ?>
<?php if ($error) : ?>
  <div class="w3-container w3-red">
    <p><?= $error; ?></p>
  </div>
<?php endif; ?>

<div class="w3-quarter">&nbsp;</div>

<div class="w3-container w3-half w3-margin-top">
  <div class="w3-container w3-card-4">
  <form method="post">
    <h2 class="w3-text-theme">Reset Password</h2>

    <div class="w3-group">      
      <input class="w3-input" type="password" name="oPass" id="oPass" value="<?= $post->oPass; ?>">
      <label for="ssn">Old Password</label>
    </div>
    <div class="w3-group">      
      <input class="w3-input" type="password" name="nPass" id="nPass" value="<?= $post->nPass; ?>">
      <label for="ssn">New Password</label>
    </div>
    <div class="w3-group">      
      <input class="w3-input" type="password" name="nPass1" id="nPass1" value="<?= $post->nPass1; ?>">
      <label for="ssn">Confirm New Password</label>
    </div>

    <br><br>
    <div class="w3-container w3-half w3-left-align">
      <button class="w3-btn w3-theme" type="submit" name="changePassword"> Submit </button>
    </div>
  </form>
  
  <br><br>
  </div>
</div>

<?php include 'VIEW_footer.php'; ?>
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
      <h2 class="w3-text-theme">New Account</h2>

      <input type="hidden" name="state" value="new">
      <div class="w3-group">      
        <select name="user" id="user">
          <option value=""></option>
          <?php
          $sql = 'SELECT id, name FROM users';
          foreach ($dbh->query($sql)->fetchAll() as $user) : 
          ?>
          <option value="<?= $user->id; ?>"<?= ($post->user === $user->id ? 'selected' : ''); ?>>
            <?= $user->name; ?>
          </option>
          <?php endforeach; ?>
        </select>
        <label for="user">User</label>
      </div>
      <div class="w3-group">      
        <input class="w3-input" type="number" name="balance" id="balance" value="<?= $post->balance; ?>" required 
               min="0" step="0.01">
        <label for="name">Initial Balance</label>
      </div>

      <br><br>
      <div class="w3-container w3-half w3-left-align">
        <button class="w3-btn w3-theme" type="submit" name="createAcc"> Submit </button>
      </div>
    </form>

    <form method="post">
      <div class="w3-container w3-half w3-right-align">
        <button class="w3-btn w3-theme" type="submit" name="cancel"> Cancel </button>
      </div>
    </form>

    <br><br>
  </div>
</div>

<?php include 'VIEW_footer.php'; ?>
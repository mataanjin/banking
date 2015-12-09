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
    <h2 class="w3-text-theme">New User</h2>

    <input type="hidden" name="state" value="new">
    <div class="w3-group">      
      <input class="w3-input" type="text" name="ssn" id="ssn" value="<?= $_POST['ssn']; ?>">
      <label for="ssn">SSN</label>
    </div>
    <div class="w3-group">      
      <input class="w3-input" type="text" name="name" id="name" value="<?= $_POST['name']; ?>" required>
      <label for="name">Name</label>
    </div>
    <div class="w3-group">      
      <input class="w3-input" type="email" name="email" id="email" value="<?= $_POST['email']; ?>" required>
      <label for="email">Email</label>
    </div>
    <div class="w3-group">      
      <input class="w3-input" type="tel" name="phone" id="phone" value="<?= $_POST['phone']; ?>" required>
      <label for="phone">Phone</label>
    </div>
    <div class="w3-group">      
      <textarea class="w3-input" name="address" id="address" required><?= $_POST['address']; ?></textarea>
      <label for="address">Address</label>
    </div>

    <br><br>
    <div class="w3-container w3-half w3-left-align">
      <button class="w3-btn w3-theme" type="submit" name="createUser"> Submit </button>
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
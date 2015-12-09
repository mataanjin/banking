<?php include 'VIEW_header.php'; ?>
<div class="w3-row-padding w3-center w3-margin-top">
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
  <div class="w3-half w3-left-align">
    <form method="post">
      <button type="submit" class="w3-btn w3-theme" name="newUser">New</button>
    </form>
  </div>
  <div class="w3-half w3-right-align">
    <form method="post">
      <input class="w3-input w3-border" style="width: 50%; display: inline-block;" type="text" name="search" placeholder="search">
      <button type="submit" class="w3-btn w3-theme" name="searchUser"><i class="material-icons">search</i></button>
    </form>
  </div>
  <!--<div class="w3-responsive">-->
  <form method="post">
    <table class="w3-table w3-bordered w3-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Last Modified</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users->fetchAll() as $value) : ?>
          <tr>
            <td><?= $value->name; ?></td>
            <td><?= $value->email; ?></td>
            <td><?= $value->modified; ?></td>
            <td>
              <button class="w3-btn w3-yellow" name="editUser" value="<?= $value->id; ?>">Edit</button>
              <button class="w3-btn w3-red" name="deleteUser" value="<?= $value->id; ?>" data-name="<?= $value->name; ?>">
                Delete
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
  <!--</div>-->
</div>

<script src="JS_userAdmMain.js"></script>

<?php include 'VIEW_footer.php'; ?>
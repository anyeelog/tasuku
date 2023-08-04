<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3>Your profile</h3>

  <div class="">
    <?php include_once __DIR__ . '/../templates/alerts.php'; ?>

    <form class="form" method="POST" action="/profile">
      <div class="camp">
        <input type="text" name="username" value="<?php echo $user->name; ?>" placeholder="Your name">
      </div>

      <div class="camp">
        <input type="text" name="user-email" id="user-email" value="<?php echo $user->email; ?>" placeholder="Your email">
      </div>

      <input type="submit" value="Save changes">
    </form>
  </div>

<?php include_once __DIR__ . '/dash-footer.php'; ?>

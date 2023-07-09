<div class="login">

  <div class="container">

    <h1><a href="/">Tasuku.</a></h1>
    <p class="tagline">Create and manage your projects</p>


    <div class="form-container">
      <p class="page-description">Restore password</p>
    <?php if($show) { ?>
      <form class="form" method="POST">

        <div class="camp">
          <input type="password" id="password" placeholder="Your password" name="password">
        </div>

    <?php } ?>
        <ul class="alerts">
          <?php
            foreach($alerts as $key => $alert) {
              foreach($alert as $message) {
          ?>
            <li class="alert <?php echo $key ?>"><?php echo $message; ?></li>
          <?php
              }
            }
          ?>
        </ul>
    <?php if($show) { ?>
        <input type="submit" class="button" value="Change password">
      </form>
    <?php } ?>
      <div class="actions">
        <p>Already have an account? <a href="/">Login</a></p>
        <p>No account? <a href="/signup">Signup</a></p>
      </div>

    </div>

  </div>

</div>

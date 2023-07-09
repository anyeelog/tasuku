<div class="login">

  <div class="container">

    <h1>Tasuku.</h1>
    <p class="tagline">Create and manage your projects</p>


    <div class="form-container">
      <p class="page-description">Signup</p>

      <form action="/signup" class="form" method="POST">

        <div class="camp">
          <input
            type="name"
            id="name"
            placeholder="Your name"
            name="name"
            value="<?php echo $user->name; ?>"
          >
        </div>

        <div class="camp">
          <input
            type="email"
            id="email"
            placeholder="Your email"
            name="email"
            value="<?php echo $user->email; ?>"
          >
        </div>

        <div class="camp">
          <input type="password" id="password" placeholder="Your password" name="password">
        </div>

        <div class="camp">
          <input type="password" id="passwordrepeat" placeholder="Repeat your password" name="passwordrepeat">
        </div>

        <ul class="alerts">
          <?php
            foreach($alerts as $key => $alert) {
              foreach($alert as $message) {
          ?>
            <li class="alert"><?php echo $message; ?></li>
          <?php
              }
            }
          ?>
        </ul>

        <input type="submit" class="button" value="Create account">
      </form>

      <div class="actions">
        <p>Already have an account? <a href="/">Login</a></p>
      </div>
    </div>

  </div>

</div>

<div class="login">

  <div class="container">

    <h1><a href="/">Tasuku.</a></h1>
    <p class="tagline">Create and manage your projects</p>


    <div class="form-container">
      <p class="page-description">Login</p>

      <form action="/" class="form" method="POST" novalidate>

        <div class="camp">
          <input type="email" id="email" placeholder="Your email" name="email">
        </div>

        <div class="camp">
          <input type="password" id="password" placeholder="Your password" name="password">
        </div>

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

        <input type="submit" class="button" value="Login">
      </form>

      <div class="actions">
        <a href="/forgotpassword">Forgot password?</a>
        <p>No account? <a href="/signup">Signup</a></p>
      </div>
    </div>

  </div>

</div>

<div class="auth-bg">
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

          <?php include_once __DIR__ . '/../templates/alerts.php'; ?>

          <input type="submit" class="button" value="Login">
        </form>

        <div class="actions">
          <a href="/forgotpassword">Forgot password?</a>
          <p>No account? <a href="/signup">Signup</a></p>
        </div>
      </div>

    </div>

  </div>
</div>

<div class="login">

  <div class="container">

    <h1><a href="/">Tasuku.</a></h1>
    <p class="tagline">Create and manage your projects</p>


    <div class="form-container">
      <p class="page-description">Forgot password?</p>
      <p style="padding: 0 50px;">Don't worry! Enter your email address and we'll send you a reset link.</p>

      <form action="/forgotpassword" class="form" method="POST" novalidate>

        <div class="camp">
          <input type="email" id="email" placeholder="Your email" name="email">
        </div>

        <?php include_once __DIR__ . '/../templates/alerts.php'; ?>

        <input type="submit" class="button" value="Send Reset Link">
      </form>

      <div class="actions">
        <p>Already have an account? <a href="/">Login</a></p>
        <p>No account? <a href="/signup">Signup</a></p>
      </div>
    </div>

  </div>

</div>

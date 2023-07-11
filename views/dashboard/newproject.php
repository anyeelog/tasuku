<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3>Create a new project</h3>

  <div class="form-container">
    <form class="form" method="POST" action="/newproject">
      <?php include_once __DIR__ . '/../dashboard/form-project.php'; ?>
      <?php include_once __DIR__ . '/../templates/alerts.php'; ?>
      <input type="submit" value="Create project">
    </form>
  </div>

<?php include_once __DIR__ . '/dash-footer.php'; ?>

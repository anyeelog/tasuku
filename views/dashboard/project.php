<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3><?php echo $project; ?></h3>

  <?php if($description) { ?>
    <p class="project-description"><?php echo substr($description, 0, 110) . '...'; ?></p>
  <?php } else { ?>
    <p class="project-description">(No description)</p>
  <?php } ?>

  <div class="tasks">
    <div class="task"></div>
  </div>


<?php include_once __DIR__ . '/dash-footer.php'; ?>

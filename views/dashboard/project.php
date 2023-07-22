<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3><?php echo $project; ?></h3>

  <?php if($description) { ?>
    <p class="project-description"><?php echo $description; ?></p>
  <?php } else { ?>
    <p class="project-description">(No description)</p>
  <?php } ?>


  <ul id="tasks" class="tasks">
    <?php if(!$task->description) { ?>
      <p class="project-description">(No description)</p>
    <?php } ?>
  </ul>


<?php include_once __DIR__ . '/dash-footer.php'; ?>

<?php $script = '<script src="build/js/tasks.js"></script>'; ?>

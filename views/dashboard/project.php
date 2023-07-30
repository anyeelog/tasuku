<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3><?php echo $project; ?></h3>

  <?php if($description) { ?>
    <p class="project-description"><?php echo $description; ?></p>
  <?php } else { ?>
    <p class="project-description">(No description)</p>
  <?php } ?>

  <div id="filters" class="filters">
    <div class="filters-inputs">
      <h2>Filters:</h2>

      <div class="camp">
        <label for="tasks-all">All</label>
        <input type="radio" name="filter" id="all-tasks" value="" checked>
      </div>

      <div class="camp">
        <label for="tasks-all">Completed</label>
        <input type="radio" name="filter" id="completed-tasks" value="1">
      </div>

      <div class="camp">
        <label for="tasks-all">Incompleted</label>
        <input type="radio" name="filter" id="incompleted-tasks" value="0">
      </div>

    </div>
  </div>


  <ul id="tasks" class="tasks">
    <?php if(!$task->description) { ?>
      <p class="project-description">(No description)</p>
    <?php } ?>
  </ul>

<?php include_once __DIR__ . '/dash-footer.php'; ?>

<?php $script .= '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="build/js/tasks.js"></script>
      ';

?>

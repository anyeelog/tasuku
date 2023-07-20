<div class="topbar">
  <p>Hello, <?php echo $_SESSION['name']; ?>!</p>

  <?php if($_SERVER['PATH_INFO'] === '/project') { ?>
    <a href="#" id="add-task" class="add-task">+ Add task</a>
  <?php } else { ?>
    <a href="#" id="add-project" class="add-project">+ Add project</a>
  <?php } ?>

</div>

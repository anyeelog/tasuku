<div class="topbar-mobile">
  <h1>Tasuku.</h1>

  <div class="menu">
    <img id="mobile-menu" src="build/img/menu.svg" alt="Menu button">
  </div>
</div>

<aside class="sidebar-mobile">

  <div class="sidebar-head">
    <h1>Tasuku.</h1>
    <img id="mobile-menu-close" src="build/img/close.svg" alt="Close menu button">
  </div>

  <nav class="sidebar-nav">
    <a href="/dashboard" class="<?php echo ($title === '| Dashboard' || $_SERVER['PATH_INFO'] === '/project') ? 'active' : '' ; ?>">Projects</a>
    <a href="/newproject" class="<?php echo ($title === '| Create Project') ? 'active' : '' ; ?>">New Project</a>
    <a href="/profile" class="<?php echo ($title === '| Profile') ? 'active' : '' ; ?>">Profile</a>
    <a href="/logout" class="">Logout</a>
  </nav>

</aside>




<div class="topbar">
  <p>Hello, <?php echo $_SESSION['name']; ?>!</p>

  <?php if($_SERVER['PATH_INFO'] === '/project') { ?>
    <a href="#" id="add-task" class="add-task">+ Add task</a>
  <?php } else { ?>
    <a href="#" id="add-project" class="add-project">+ Add project</a>
  <?php } ?>

</div>

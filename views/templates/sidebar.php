<aside class="sidebar">

  <h2><a href="/dashboard">Tasuku.</a></h2>

  <nav class="sidebar-nav">
    <a href="/dashboard" class="<?php echo ($title === '| Dashboard' || $_SERVER['PATH_INFO'] === '/project') ? 'active' : '' ; ?>">Projects</a>
    <a href="/newproject" class="<?php echo ($title === '| Create Project') ? 'active' : '' ; ?>">New Project</a>
    <a href="/profile" class="<?php echo ($title === '| Profile') ? 'active' : '' ; ?>">Profile</a>
    <a href="/logout" class="">Logout</a>
  </nav>

</aside>

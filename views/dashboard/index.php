<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3>You have things to do!</h3>

  <?php if(count($projects) === 0) { ?>

    <h2>There are no projects yet! Do you want to create one?</h2>
    <a href="/newproject" class="<?php echo ($title === '| Create Project') ? 'active' : '' ; ?>">New Project</a>

  <?php } else { ?>

    <ul class="projects-list">
      <?php foreach($projects as $project) { ?>

        <li class="project-container">
          <a href="/project?id=<?php echo $project->url; ?>">
            <h4><?php echo $project->project; ?></h4>
            <p><?php echo $project->description; ?></p>
          </a>
        </li>

      <?php } ?>
    </ul>

  <?php } ?>

<?php include_once __DIR__ . '/dash-footer.php'; ?>

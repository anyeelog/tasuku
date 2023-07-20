<?php include_once __DIR__ . '/dash-header.php'; ?>

  <h3>You have things to do!</h3>

  <div class="dash-index">
    <div class="index-projects">

      <h4 class="projects-title">Your projects</h4>

      <?php if(count($projects) === 0) { ?>

        <h2>There are no projects yet! Do you want to create one?</h2>
        <a href="/newproject" class="<?php echo ($title === '| Create Project') ? 'active' : '' ; ?>">New Project</a>

      <?php } else { ?>

        <div class="projects-list">
          <?php foreach($projects as $project) { ?>

              <a href="/project?id=<?php echo $project->url; ?>">
                <h4><?php echo $project->project; ?></h4>

                <?php if($project->description) { ?>
                  <p class="project-description"><?php echo substr($project->description, 0, 60) . '...'; ?></p>
                <?php } else { ?>
                  <p class="project-description">(No description)</p>
                <?php } ?>
              </a>

          <?php } ?>
          </div>

      <?php } ?>
    </div> <!-- .projects -->


    <div class="index-tasks">

      <h4 class="tasks-title">Tasks due today</h4>

    </div> <!-- .tasks -->
  </div> <!-- .dash-index -->

<?php include_once __DIR__ . '/dash-footer.php'; ?>

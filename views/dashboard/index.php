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

      <ul id="tasks-dash" class="tasks-dash">

        <li class="task-dash">
          <div class="task-header">
            <h4 class="task-name">Create a list of icons</h4>
            <button class="delete-task" data-id-task="1"><img src="https://img.icons8.com/?size=512&amp;id=G3ke6AwujrRv&amp;format=png" height="32px" alt="Delete button"></button>
          </div>

          <p class="task-description">
            Design new icons for the company. They don't want round icons and must have red color...
          </p>

          <div class="task-footer">
            <button class="toggle-task" data-id-task="1">Complete</button>
            <p class="task-status incompleted" data-status-task="0">Incompleted</p>
          </div>
        </li> <!-- .task-dash -->

        <li class="task-dash">
          <div class="task-header">
            <h4 class="task-name">Talk with Jason</h4>
            <button class="delete-task" data-id-task="1"><img src="https://img.icons8.com/?size=512&amp;id=G3ke6AwujrRv&amp;format=png" height="32px" alt="Delete button"></button>
          </div>

          <p class="task-description">
           Need to confirm that the doc doesn't have any errors.
          </p>

          <div class="task-footer">
            <button class="toggle-task" data-id-task="1">Complete</button>
            <p class="task-status incompleted" data-status-task="0">Incompleted</p>
          </div>
        </li> <!-- .task-dash -->

        <li class="task-dash">
          <div class="task-header">
            <h4 class="task-name">Grocery shopping for tonights dinner</h4>
            <button class="delete-task" data-id-task="1"><img src="https://img.icons8.com/?size=512&amp;id=G3ke6AwujrRv&amp;format=png" height="32px" alt="Delete button"></button>
          </div>

          <p class="task-description">
            Ingredients needed: carrots, apple, lamb, onions...
          </p>

          <div class="task-footer">
            <button class="toggle-task" data-id-task="1">Complete</button>
            <p class="task-status incompleted" data-status-task="0">Incompleted</p>
          </div>
        </li> <!-- .task-dash -->
      </ul>

    </div> <!-- .tasks -->
  </div> <!-- .dash-index -->

<?php include_once __DIR__ . '/dash-footer.php'; ?>

// Button to show add project form
const addProjectButton = document.querySelector('#add-project');
addProjectButton.addEventListener('click', showForm);

function showForm() {
  // Inserting add task form to the interface
  const modal = document.createElement('DIV');
  modal.classList.add('modal');
  modal.innerHTML = `
    <div class="form-container">
      <p class="page-description">Add a new project</p>
      <p style="margin: 20px 0 40px 0;">Create the project you want to work in and start organizing your tasks!</p>
      <form class="form form-task">
        <div class="camp">
          <input type="text" name="project" id="project" placeholder="Project title">
        </div>
        <div class="camp">
          <input type="text" name="project-description" id="project-description" placeholder="Project description">
        </div>
        <div class="options">
          <input type="submit" class="submit-new-task" value="Add project">
          <button type="button" class="close-modal">Cancel</button>
        </div>
      </form>
    </div>
  `;

  // Animation when form appears
  setTimeout(() => {
    const form = document.querySelector('.form-container');
    form.classList.add('animate');
  }, 0);

  modal.addEventListener('click', function(e) {
    e.preventDefault();

    if(e.target.classList.contains('close-modal')) {
      modal.remove();
    }
    if(e.target.classList.contains('submit-new-task')) {
      const taskName = document.querySelector('#task').value.trim();
      const taskDescription = document.querySelector('#task-description').value.trim();

      if(taskName === '') {
        showAlert('Project name is required', 'error', document.querySelector('.options'));
        return;
      }

      addProject(taskName, taskDescription);
    }
  });

  document.querySelector('body').appendChild(modal);
}

async function addProject(project, description) {
  const data = new FormData();
  data.append('project', project);
  data.append('description', description);

  try {
    const url = 'http://localhost:3000/dashboard';
    const response = await fetch(url, {
      method: 'POST',
      body: data
    });

    const result = await response.json();
    showAlert(result.message, result.type, document.querySelector('.options'));

    if(result.type === 'success') {
      const modal = document.querySelector('.modal');
      modal.remove();

      // Add project to projects
      const projectObj = {
        id: String(result.id),
        name: project,
        description: description
      }

      projects = [...projects, projectObj];
      showProjects();
    }

  } catch (error) {
    console.log(error);
  }


}

(function() {

  getTasks();
  let tasks = [];

  // Button to show add task form
  const addTaskButton = document.querySelector('#add-task');
  addTaskButton.addEventListener('click', showForm);

  async function getTasks() {
    try {
      const id = getProject();
      const url = `/api/tasks?id=${id}`;
      const response = await fetch(url);
      const result = await response.json();
      tasks = result.tasks;

      showTasks();

    } catch(error) {
      console.log(error);
    }
  }

  function showTasks() {
    cleanTasks();

    if(tasks.length === 0) {
      const tasksContainer = document.querySelector('#tasks');
      const emptyText = document.createElement('LI');
      emptyText.textContent = 'There are no tasks';
      emptyText.classList.add('no-tasks');
      tasksContainer.appendChild(emptyText);
      return;
    }

    const status = {
      0: 'Incompleted',
      1: 'Completed'
    }

    tasks.forEach(task => {
      // HTML for task
      const taskContainer = document.createElement('LI');
      taskContainer.dataset.taskId = task.id;
      taskContainer.classList.add('task');

      const taskHeader = document.createElement('DIV');
      taskHeader.classList.add('task-header');


      const taskName = document.createElement('H4');
      taskName.classList.add('task-name');
      taskName.textContent = task.name;

      const taskDescription = document.createElement('P');
      taskDescription.classList.add('task-description');

      if(!task.description) {
        taskDescription.textContent = '(No description)';
      } else {
        taskDescription.textContent = task.description;
      }

      const taskFooter = document.createElement('DIV');
      taskFooter.classList.add('task-footer');

      const taskStatus = document.createElement('P');
      taskStatus.classList.add('task-status');
      taskStatus.classList.add(`${status[task.status].toLowerCase()}`);
      taskStatus.textContent = status[task.status];
      taskStatus.dataset.statusTask = task.status;

      // Buttons
      const btnToggleStatus = document.createElement('BUTTON');
      btnToggleStatus.classList.add('toggle-task');
      btnToggleStatus.dataset.idTask = task.id;
      // btnToggleStatus.textContent = status[task.status];
      btnToggleStatus.textContent = 'Complete Task';
      btnToggleStatus.onclick = function() {
        changeTaskStatus({...task});
      }

      const trashIcon = document.createElement('IMG');
      trashIcon.setAttribute('src', 'https://img.icons8.com/?size=512&id=G3ke6AwujrRv&format=png');
      trashIcon.setAttribute('height', '32px');
      trashIcon.setAttribute('alt', 'Delete button');

      const btnDeleteTask = document.createElement('BUTTON');
      btnDeleteTask.classList.add('delete-task');
      btnDeleteTask.dataset.idTask = task.id;

      // Organizing task container
      taskContainer.appendChild(taskHeader);

      taskContainer.appendChild(taskDescription);

      taskContainer.appendChild(taskFooter);

      taskHeader.appendChild(taskName);
      btnDeleteTask.appendChild(trashIcon);
      taskHeader.appendChild(btnDeleteTask);

      taskFooter.appendChild(btnToggleStatus);
      taskFooter.appendChild(taskStatus);


      // taskFooter.appendChild(btnDeleteTask);
      // add due date taskFooter.appendChild(btnTaskStatus);

      const taskList = document.querySelector('#tasks');
      taskList.appendChild(taskContainer);
    })
  }

  function showForm() {
    // Inserting add task form to the interface
    const modal = document.createElement('DIV');
    modal.classList.add('modal');
    modal.innerHTML = `
      <div class="form-container">
        <p class="page-description">Add a new task</p>
        <p style="padding: 0 50px;">Don't worry! Enter your email address and we'll send you a reset link.</p>
        <form class="form form-task">
          <div class="camp">
            <input type="text" name="task" id="task" placeholder="Task title">
          </div>
          <div class="camp">
            <input type="text" name="task-description" id="task-description" placeholder="Task description">
          </div>
          <div class="options">
            <input type="submit" class="submit-new-task" value="Add task">
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
        submitNewTask();
      }

    });

    document.querySelector('body').appendChild(modal);
  }

  function submitNewTask() {
    const task = document.querySelector('#task').value.trim();
    const description = document.querySelector('#task-description').value.trim();

    if(task === '') {
      showAlert('Task name is required', 'error', document.querySelector('.options'));
      return;
    }

    addTask(task, description);
  }

  function showAlert(message, type, reference) {
    // Removes previous alert (avoids duplicate)
    const previousAlert = document.querySelector('.alerts');
    if(previousAlert){ previousAlert.remove() };

    // Inserts alert
    const alerts = document.createElement('UL');
    alerts.classList.add('alerts');
    alerts.innerHTML = `<li class="alert ${type}">${message}</li>`;

    reference.parentElement.insertBefore(alerts, reference);
  }

  async function addTask(task, description) {
    const data = new FormData();
    data.append('name', task);
    data.append('description', description);
    data.append('project_id', getProject())

    try {

      const url = 'http://localhost:3000/api/task';
      const response = await fetch(url, {
        method: 'POST',
        body: data
      });

      const result = await response.json();

      showAlert(result.message, result.type, document.querySelector('.options'));

      if(result.type === 'success') {
        const modal = document.querySelector('.modal');
        modal.remove();

        // Add task to tasks
        const taskObj = {
          id: String(result.id),
          name: task,
          description: description,
          status: "0",
          project_id: result.project_id
        }

        tasks = [...tasks, taskObj];
        showTasks();
      }

    } catch (error) {
      console.log(error);
    }
  }

  function changeTaskStatus(task) {
    const newStatus = task.status === "1" ? "0" : "1";
    task.status = newStatus;
    updateTaskStatus(task);
  }

  async function updateTaskStatus(task) {
    const {id, name, description, status, project_id} = task;
    const data = new FormData();

    data.append('id', id);
    data.append('name', name);
    data.append('description', description);
    data.append('status', status);
    data.append('project_id', project_id);
    data.append('url', getProject());

    try {
      const url = 'http://localhost:3000/api/task/update';
      const response = await fetch(url, {
        method: 'POST',
        body: data
      });

      const result = await response.json();

      if(result.response.type === 'success') {
        console.log('Correctly updated.')
      }

    } catch(error) {
      console.log(error);
    }


  }

  function getProject() {
    const projectParams = new URLSearchParams(window.location.search);
    const project = Object.fromEntries(projectParams.entries());
    return project.id;
  }

  function cleanTasks() {
    const tasksContainer = document.querySelector('#tasks');

    while(tasksContainer.firstChild) {
      tasksContainer.removeChild(tasksContainer.firstChild);
    }
  }

})();

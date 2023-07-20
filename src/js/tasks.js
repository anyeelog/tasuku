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
      const taskContainer = document.createElement('LI');
      taskContainer.dataset.taskId = task.id;
      taskContainer.classList.add('task');

      const taskName = document.createElement('P');
      taskName.textContent = task.name;

      const optionsDiv = document.createElement('DIV');
      optionsDiv.classList.add('options');

      // Buttons
      const btnTaskStatus = document.createElement('BUTTON');
      btnTaskStatus.classList.add('task-state');
      btnTaskStatus.classList.add(`${status[task.status].toLowerCase()}`);
      btnTaskStatus.textContent = status[task.status];
      btnTaskStatus.dataset.statusTask = task.status;
      btnTaskStatus.onclick = function() {
        changeTaskStatus({...task});
      }

      const btnDeleteTask = document.createElement('BUTTON');
      btnDeleteTask.classList.add('delete-task');
      btnDeleteTask.dataset.idTask = task.id;
      btnDeleteTask.textContent = 'Delete';

      optionsDiv.appendChild(btnTaskStatus);
      optionsDiv.appendChild(btnDeleteTask);

      taskContainer.appendChild(taskName);
      taskContainer.appendChild(optionsDiv);

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

    if(task === '') {
      showAlert('Task name is required', 'error', document.querySelector('.options'));
      return;
    }

    addTask(task);
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

  async function addTask(task) {
    const data = new FormData();
    data.append('name', task);
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
    const {id, name, status, project_id} = task;
    const data = new FormData();

    data.append('id', id);
    data.append('name', name);
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
      console.log(response);

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

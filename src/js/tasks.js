(function() {

  // Button to show add task form
  const addTaskButton = document.querySelector('#add-task');
  addTaskButton.addEventListener('click', showForm);

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
            <input type="text" name="project-select" id="project-select" placeholder="Select project">
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
      console.log(e);

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
    const projectSelect = document.querySelector('#project-select').value.trim();
    if(task === '') {
      showAlert('Task name is required', 'error', document.querySelector('.options'));
      return;
    }
    if(projectSelect === '') {
      showAlert('Choose a project', 'error', document.querySelector('.options'));
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

})();

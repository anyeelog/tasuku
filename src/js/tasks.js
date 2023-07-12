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



    document.querySelector('body').appendChild(modal);
  }

})();

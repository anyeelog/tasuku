const addProjectButton=document.querySelector("#add-project");function showForm(){const t=document.createElement("DIV");t.classList.add("modal"),t.innerHTML='\n    <div class="form-container">\n      <p class="page-description">Add a new project</p>\n      <p style="margin: 20px 0 40px 0;">Create the project you want to work in and start organizing your tasks!</p>\n      <form class="form form-task">\n        <div class="camp">\n          <input type="text" name="project" id="project" placeholder="Project title">\n        </div>\n        <div class="camp">\n          <input type="text" name="project-description" id="project-description" placeholder="Project description">\n        </div>\n        <div class="options">\n          <input type="submit" class="submit-new-task" value="Add project">\n          <button type="button" class="close-modal">Cancel</button>\n        </div>\n      </form>\n    </div>\n  ',setTimeout(()=>{document.querySelector(".form-container").classList.add("animate")},0),t.addEventListener("click",(function(e){if(e.preventDefault(),e.target.classList.contains("close-modal")&&t.remove(),e.target.classList.contains("submit-new-task")){const t=document.querySelector("#task").value.trim(),e=document.querySelector("#task-description").value.trim();if(""===t)return void showAlert("Project name is required","error",document.querySelector(".options"));addProject(t,e)}})),document.querySelector("body").appendChild(t)}async function addProject(t,e){const o=new FormData;o.append("project",t),o.append("description",e);try{const n="http://localhost:3000/dashboard",c=await fetch(n,{method:"POST",body:o}),r=await c.json();if(showAlert(r.message,r.type,document.querySelector(".options")),"success"===r.type){document.querySelector(".modal").remove();const o={id:String(r.id),name:t,description:e};projects=[...projects,o],showProjects()}}catch(t){console.log(t)}}addProjectButton.addEventListener("click",showForm);
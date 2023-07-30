!function(){!async function(){try{const e="/api/tasks?id="+c(),n=await fetch(e),a=await n.json();t=a.tasks,s()}catch(t){console.log(t)}}();let t=[],e=[];document.querySelector("#add-task").addEventListener("click",(function(){const e=document.createElement("DIV");e.classList.add("modal"),e.innerHTML='\n      <div class="form-container">\n        <p class="page-description">Add a new task</p>\n        <p style="padding: 0 50px;">Don\'t worry! Enter your email address and we\'ll send you a reset link.</p>\n        <form class="form form-task">\n          <div class="camp">\n            <input type="text" name="task" id="task" placeholder="Task title">\n          </div>\n          <div class="camp">\n            <input type="text" name="task-description" id="task-description" placeholder="Task description">\n          </div>\n          <div class="options">\n            <input type="submit" class="submit-new-task" value="Add task">\n            <button type="button" class="close-modal">Cancel</button>\n          </div>\n        </form>\n      </div>\n    ',setTimeout(()=>{document.querySelector(".form-container").classList.add("animate")},0),e.addEventListener("click",(function(n){if(n.preventDefault(),n.target.classList.contains("close-modal")&&e.remove(),n.target.classList.contains("submit-new-task")){const e=document.querySelector("#task").value.trim(),n=document.querySelector("#task-description").value.trim();if(""===e)return void a("Task name is required","error",document.querySelector(".options"));!async function(e,n){const o=new FormData;o.append("name",e),o.append("description",n),o.append("project_id",c());try{const c="http://localhost:3000/api/task",i=await fetch(c,{method:"POST",body:o}),d=await i.json();if(a(d.message,d.type,document.querySelector(".options")),"success"===d.type){document.querySelector(".modal").remove();const a={id:String(d.id),name:e,description:n,status:"0",project_id:d.project_id};t=[...t,a],s()}}catch(t){console.log(t)}}(e,n)}})),document.querySelector("body").appendChild(e)}));function n(n){const a=n.target.value;e=""!==a?t.filter(t=>t.status===a):[],s()}function s(){!function(){const t=document.querySelector("#tasks");for(;t.firstChild;)t.removeChild(t.firstChild)}(),function(){const e=t.filter(t=>"0"===t.status),n=document.querySelector("#incompleted-tasks");0===e.length?n.disabled=!0:n.disabled=!1}(),function(){const e=t.filter(t=>"1"===t.status),n=document.querySelector("#completed-tasks");0===e.length?n.disabled=!0:n.disabled=!1}();const n=e.length?e:t;if(0===n.length){const t=document.querySelector("#tasks"),e=document.createElement("LI");return e.textContent="There are no tasks",e.classList.add("no-tasks"),void t.appendChild(e)}const i={0:"Incompleted",1:"Completed"};n.forEach(e=>{const n=document.createElement("LI");n.dataset.taskId=e.id,n.classList.add("task");const d=document.createElement("DIV");d.classList.add("task-header");const r=document.createElement("H4");r.classList.add("task-name"),r.textContent=e.name,r.onclick=function(){console.log(e),function(t){const e=document.createElement("DIV");e.classList.add("modal"),e.innerHTML=`\n      <div class="form-container">\n        <p class="page-description">Edit task</p>\n        <p style="padding: 0 50px;">Don't worry! Enter your email address and we'll send you a reset link.</p>\n        <form class="form form-task">\n          <div class="camp">\n            <input type="text" name="task" id="task" placeholder="Task title" value="${t.name?t.name:""}">\n          </div>\n          <div class="camp">\n            <input type="text" name="task-description" id="task-description" placeholder="Task description" value="${t.description?t.description:""}">\n          </div>\n          <div class="options">\n            <input type="submit" class="submit-new-task" value="Edit task">\n            <button type="button" class="close-modal">Cancel</button>\n          </div>\n        </form>\n      </div>\n    `,setTimeout(()=>{document.querySelector(".form-container").classList.add("animate")},0),e.addEventListener("click",(function(n){if(n.preventDefault(),n.target.classList.contains("close-modal")&&e.remove(),n.target.classList.contains("submit-new-task")){const e=document.querySelector("#task").value.trim(),n=document.querySelector("#task-description").value.trim();if(""===e)return void a("Task name is required","error",document.querySelector(".options"));t.name=e,t.description=n,o(t)}})),document.querySelector("body").appendChild(e)}({...e})};const l=document.createElement("P");l.classList.add("task-description"),e.description?l.textContent=e.description:l.textContent="(No description)";const u=document.createElement("DIV");u.classList.add("task-footer");const p=document.createElement("P");p.classList.add("task-status"),p.classList.add(""+i[e.status].toLowerCase()),p.textContent=i[e.status],p.dataset.statusTask=e.status;const m=document.createElement("BUTTON");m.classList.add("toggle-task"),m.dataset.idTask=e.id,m.textContent="Complete Task",m.onclick=function(){!function(t){const e="1"===t.status?"0":"1";t.status=e,o(t)}({...e})};const f=document.createElement("IMG");f.setAttribute("src","https://img.icons8.com/?size=512&id=G3ke6AwujrRv&format=png"),f.setAttribute("height","32px"),f.setAttribute("alt","Delete button");const k=document.createElement("BUTTON");k.classList.add("delete-task"),k.dataset.idTask=e.id,k.onclick=function(){!function(e){Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then(n=>{n.isConfirmed&&async function(e){const{id:n,name:a,description:o,status:i}=e,d=new FormData;d.append("id",n),d.append("name",a),d.append("description",o),d.append("status",i),d.append("url",c());try{const n="http://localhost:3000/api/task/delete",a=await fetch(n,{method:"POST",body:d});(await a.json()).result&&(Swal.fire("Deleted!","The task has been deleted.","success"),t=t.filter(t=>t.id!==e.id),s())}catch(t){}}(e)})}({...e})},n.appendChild(d),n.appendChild(l),n.appendChild(u),d.appendChild(r),k.appendChild(f),d.appendChild(k),u.appendChild(m),u.appendChild(p);document.querySelector("#tasks").appendChild(n)})}function a(t,e,n){const s=document.querySelector(".alerts");s&&s.remove();const a=document.createElement("UL");a.classList.add("alerts"),a.innerHTML=`<li class="alert ${e}">${t}</li>`,n.parentElement.insertBefore(a,n)}async function o(e){const{id:n,name:a,description:o,status:i}=e,d=new FormData;d.append("id",n),d.append("name",a),d.append("description",o),d.append("status",i),d.append("url",c());try{const e="http://localhost:3000/api/task/update",c=await fetch(e,{method:"POST",body:d}),r=await c.json();if("success"===r.response.type){Swal.fire(r.response.message,r.response.message,"success");const e=document.querySelector(".modal");e&&e.remove(),t=t.map(t=>(t.id===n&&(t.status=i,t.name=a,t.description=o),t)),s()}}catch(t){console.log(t)}}function c(){const t=new URLSearchParams(window.location.search);return Object.fromEntries(t.entries()).id}document.querySelectorAll('#filters input[type="radio"]').forEach(t=>{t.addEventListener("input",n)})}();
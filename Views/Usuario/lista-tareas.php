			<?php
      include "Views/Templates/header.php"; ?>
			<div class="page-wrapper">
			  <div class="page-content">
			    <!--breadcrumb-->
			    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			      <div class="breadcrumb-title pe-3">Lista de tareas</div>
			      <div class="ps-3">
			        <!-- <nav aria-label="breadcrumb">
			          <ol class="breadcrumb mb-0 p-0">
			            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
			            </li>
			            <li class="breadcrumb-item active" aria-current="page">Lista de tareas</li>
			          </ol>
			        </nav> -->
			      </div>
			    </div>
			    <!--end breadcrumb-->
			    <div class="card">
			      <div class="card-body">
			        <h4 class="mb-0 text-center">Tareas</h4>
			        <hr />
			        <div class="row gy-3">
			          <div class="col-md-10">
			            <input id="todo-input" type="text" class="form-control" value="">
			          </div>
			          <div class="col-md-2 text-end d-grid">
			            <button type="button" onclick="CreateTodo();" class="btn btn-primary">Agregar tarea</button>
			          </div>
			        </div>
			        <div class="form-row mt-3">
			          <div class="col-12">
			            <div id="todo-container"></div>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<script>
			  // Obtenemos los datos del localStorage si existen
			  var todos = JSON.parse(localStorage.getItem('todos')) || [];

			  var currentTodo = {
			    text: "",
			    done: false,
			    id: 0
			  };

			  document.getElementById("todo-input").oninput = function(e) {
			    currentTodo.text = e.target.value;
			  };

			  function DrawTodo(todo) {
			    var newTodoHTML = `
			<div class="pb-3 todo-item" todo-id="${todo.id}">
				<div class="input-group">
					
						<div class="input-group-text">
							<input type="checkbox" onchange="TodoChecked(${todo.id})" aria-label="Checkbox for following text input" ${todo.done&& "checked"}>
						</div>
					
					<input type="text" readonly class="form-control ${todo.done&&" todo-done "} " aria-label="Text input with checkbox" value="${todo.text}">
					
						<button todo-id="${todo.id}" class="btn btn-outline-secondary bg-danger text-white" type="button" onclick="DeleteTodo(this);" id="button-addon2 ">X</button>
					
				</div>
			</div>
			  `;
			    var dummy = document.createElement("DIV");
			    dummy.innerHTML = newTodoHTML;
			    document.getElementById("todo-container").appendChild(dummy.children[0]);
			    /*
			    	//jQuery version
			    	 var newTodo = $.parseHTML(newTodoHTML);
			    	 $("#todo-container").append(newTodo);
			    	*/
			  }

			  function RenderAllTodos() {
			    var container = document.getElementById("todo-container");
			    while (container.firstChild) {
			      container.removeChild(container.firstChild);
			    }

			    for (var i = 0; i < todos.length; i++) {
			      DrawTodo(todos[i]);
			    }
			  }
			  RenderAllTodos();

			  function DeleteTodo(button) {
			    var deleteID = parseInt(button.getAttribute("todo-id"));

			    for (let i = 0; i < todos.length; i++) {
			      if (todos[i].id === deleteID) {
			        todos.splice(i, 1);
			        RenderAllTodos();
			        break;
			      }
			    }

			    // Actualizamos el localStorage
			    localStorage.setItem('todos', JSON.stringify(todos));
			  }

			  function TodoChecked(id) {
			    todos[id].done = !todos[id].done;
			    RenderAllTodos();

			    // Actualizamos el localStorage
			    localStorage.setItem('todos', JSON.stringify(todos));
			  }

			  function CreateTodo() {
			    newtodo = {
			      text: currentTodo.text,
			      done: false,
			      id: todos.length
			    }
			    todos.push(newtodo);
			    RenderAllTodos();

			    // Actualizamos el localStorage
			    localStorage.setItem('todos', JSON.stringify(todos));
			  }
			</script>

			<?php include "Views/Templates/footer.php"; ?>
/** @format */

document.addEventListener("DOMContentLoaded", function () {
  const addBtn = document.getElementById("add-btn");
  const todoInput = document.getElementById("todo-input");
  const todoList = document.getElementById("todo-list");

  function addTodo() {
    const todoText = todoInput.value.trim();

    if (todoText === "") {
      alert("Please enter a todo item!");
      return;
    }

    const li = document.createElement("li");
    li.className =
      "list-group-item d-flex justify-content-between align-items-center";

    // Create span for text
    const span = document.createElement("span");
    span.textContent = todoText;

    // Create delete button
    const deleteBtn = document.createElement("button");
    deleteBtn.className = "btn btn-sm btn-danger";
    deleteBtn.textContent = "Delete";

    deleteBtn.addEventListener("click", function () {
      li.remove();
    });

    li.appendChild(span);
    li.appendChild(deleteBtn);
    todoList.appendChild(li);

    todoInput.value = "";
  }

  addBtn.addEventListener("click", addTodo);

  todoInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      addTodo();
    }
  });
});

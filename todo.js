/** @format */

const todos = [
  { title: "Do homework", done: false },
  { title: "Buy groceries", done: true },
  { title: "Read a book", done: false },
  { title: "Walk the dog", done: true },
  { title: "Clean the room", done: true },
  { title: "Cook dinner", done: false },
];

const completedTasks = todos.filter((todo) => todo.done);
const ongoingTasks = todos.filter((todo) => !todo.done);

console.log("=== Ongoing Tasks ===");
ongoingTasks.forEach((task) => console.log(task.title));

console.log("\n=== Done Tasks ===");
completedTasks.forEach((task) => console.log(task.title));

<?php
// Function to load tasks from tasks.json
function loadTasks() {
    if (file_exists('tasks.json')) {
        $json = file_get_contents('tasks.json');
        return json_decode($json, true) ?? [];
    }
    return [];
}

// Function to save tasks to tasks.json
function saveTasks($tasks) {
    file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
}

// Handle form submission for adding a task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim(htmlspecialchars($_POST['task']));
    if (!empty($task)) {
        $tasks = loadTasks();
        $tasks[] = ['task' => $task, 'done' => false];
        saveTasks($tasks);
        header('Location: task.php'); // Redirect after adding
        exit;
    }
}

// Handle task marking
if (isset($_GET['mark'])) {
    $tasks = loadTasks();
    $index = (int)$_GET['mark'];
    if (isset($tasks[$index])) {
        $tasks[$index]['done'] = !$tasks[$index]['done'];
        saveTasks($tasks);
    }
    header('Location: task.php'); // Redirect after marking
    exit;
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $tasks = loadTasks();
    $index = (int)$_GET['delete'];
    if (isset($tasks[$index])) {
        unset($tasks[$index]);
        $tasks = array_values($tasks); // Reindex the array
        saveTasks($tasks);
    }
    header('Location: task.php'); // Redirect after deletion
    exit;
}

// Load tasks for display
$tasks = loadTasks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <div style="width:512px;height:512px;margin:0 auto;">
            <lottie-player src="./assets/todo.json" background="transparent" speed="1" loop autoplay width="300px"
                height="300px"></lottie-player>
        </div>

        <h1>Simple To-Do App</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Add a new task" required>
            <button type="submit" class="button">Add Task</button>
        </form>
        <ul>
            <?php foreach ($tasks as $index => $task): ?>
            <li class="<?= $task['done'] ? 'done' : '' ?>">
                <label class="task-label">
                    <input type="checkbox" onclick="location.href='task.php?mark=<?= $index ?>'"
                        <?= $task['done'] ? 'checked' : '' ?> class="checkbox">
                    <span class="task-text"><?= htmlspecialchars($task['task']) ?></span>
                </label>
                <a href="task.php?delete=<?= $index ?>" class="trash-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <footer style="text-align: center; font-size: 12px; color: #666; margin-top: 20px;">
        <p>Developer by Tareq Monower. <?= date('d-m-Y') ?> </p>

    </footer>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>

</html>
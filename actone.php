<?php
    session_start();

    // Initialize $todoList
    $todoList = array();
    if (isset($_SESSION["todoList"])) $todoList = $_SESSION["todoList"];

    // Define functions
    function appendData($data) {
        global $todoList;
        $todoList[] = $data;
        return $todoList;
    }

    function deleteData($toDelete, $todoList) {
        $index = array_search($toDelete, $todoList);
        if ($index !== false) {
            unset($todoList[$index]);
        }
        return $todoList;
    }

    // Handle form submission
    if($_SERVER["REQUEST_METHOD"] =="POST") {
        if (empty( $_POST["task"] )){
            echo '<script>alert("Error: there is no data to add in array")</script>';
            exit;
        }

        appendData($_POST["task"]);
        $_SESSION["todoList"] = $todoList;
    }

    // Handle task deletion
    if (isset($_GET['task'])) {
        $_SESSION["todoList"] = deleteData($_GET['task'], $todoList);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Tasks</title>
    <!-- Bootstrap CSS -->;
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a7e2ff;
        }
        h1 {
            text-align: center;
            color: #ff5b77;
            margin-top: 30px;
        }
        .card {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .card-header {
            background-color: #ffa7b6;
            color: #fff;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            padding: 20px;
            background-color: #ffc1cb;
        }
        .form-control {
            border-radius: 6px;
        }
        .btn-primary {
            border-radius: 6px;
            background-color: #ff5b77;
        }
        .list-group-item {
            border-radius: 6px;
        }
        .btn-danger {
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Tasks to Do</h1>
        <div class="card">
            <div class="card-header">Add a New Task</div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="task" placeholder="Enter your task here">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Tasks</div>
            <ul class="list-group list-group-flush">
            <?php
                // Check if $todoList is not empty before iterating
                if (!empty($todoList)) {
                    foreach ($todoList as $task) {
                        echo '<div class="d-flex p-2 bd-highlight w-100 justify-content-between"> <li class="list-group-item w-100">' . $task . ' </li><a href="index.php?delete=true&task=' . $task . '" class="btn btn-danger">Delete</a></div>';
                    }
                } else {
                    echo '<div class="list-group-item">No tasks</div>';
                }
            ?>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

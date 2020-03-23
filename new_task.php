<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: verify_login.php");
    exit();
}
if (isset($_POST['edit_task'])) {
    $task_type = 'edit_task';
} else {
    $task_type = 'new_task';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/theme.css">
    <link rel="stylesheet" type="text/css" href="static/css/styles.css">
    <script src="theme.js"></script>
    <script src="popup.js"></script>
    <title>Task Manager</title>
</head>

<body class="<?php echo $_COOKIE['theme']; ?>">
    <h1><?php echo $_SESSION["user"]; ?>'s Task Manager</h1>
    <button type="button" onclick="toggleTheme()" id="name">Light Mode</button>
    <br>
    <form action="tasks.php">
        <input type="submit" value="Back">
    </form>

    <form action="export_task.php" method="POST" onsubmit="return pop_up_export()">
        <input type="hidden" name="title" value="<?php echo $_POST["title"] ?>" id="title">
        <input type="hidden" name="description" value="<?php echo $_POST["description"] ?>" id="description">
        <input type="hidden" name="due_date" value="<?php echo $_POST["due_date"] ?>" id="due_date">
        <input type="submit" value="Export Tasks" name="export_task">
    </form>

    <div class="form">
        <form action="verify_task.php" method="POST">
            <label>Title</label>
            <input type="text" placeholder="Enter Title" name="title" value="<?php echo $_POST["title"] ?>"><br>

            <label>Description</label>
            <textarea type="textarea" placeholder="Enter Description" name="description" rows="10" cols="30" ><?php echo $_POST["description"] ?></textarea><br>

            <label>Due Date</label>
            <input type="date" name="due_date" value="<?php echo $_POST["due_date"] ?>"><br>

            <input type="hidden" name="id" value="<?php echo $_POST["id"] ?>">

            <input type="submit" value="Add Task" name="<?php echo $task_type ?>" class="form">
            <!-- Button overlapped with div background, couldn't fix with css. -->
            <br> <br>

        </form>
    </div>

</body>


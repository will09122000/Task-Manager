<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: verify_login.php");
    exit();
}

ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);

$errors = array();
$db = mysqli_connect('emps-sql.ex.ac.uk', 'wc352', 'wc352', 'wc352', '3306');

if (isset($_POST['new_task'])) {
    $username = $_SESSION["user"];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $done = False;

    if (empty($errors)) {
        $query = "INSERT INTO tasks (username, title, description, due_date, done) VALUES('$username', '$title', '$description', '$due_date', '$done')";
        mysqli_query($db, $query);
        header("location: tasks.php");
        exit();
    } else {
        $_SESSION["errors"] = $errors;
    }
}

if (isset($_POST['edit_task'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $query = "UPDATE tasks SET title='$title', description='$description', due_date='$due_date' WHERE id='$id'";
    mysqli_query($db, $query);
    header("location: tasks.php");
    exit();
}

if (isset($_POST['delete_task'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM tasks WHERE id='$id'";
    mysqli_query($db, $query);
    header("location: tasks.php");
    exit();
}

<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: verify_login.php");
    exit();
}

$db = mysqli_connect('emps-sql.ex.ac.uk', 'wc352', 'wc352', 'wc352', '3306');
if ($db->connect_error) {
    exit('Could not connect');
}

$id = $_GET['id'];

$query = "UPDATE tasks SET done = 1 WHERE id = '".$id."'";

mysqli_query($db, $query);

<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: login.php");
    exit();
}
$url = "http://students.emps.ex.ac.uk/dm656/tasks.php";
if (($handle = curl_init())===false) {
    echo 'Curl-Error: ' . curl_error($handle);
} else {
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_FAILONERROR, true);
}
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HTTPGET, true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/theme.css">
    <link rel="stylesheet" type="text/css" href="static/css/styles.css">
    <script src="theme.js"></script>
    <script src="done.js"></script>
    <script src="popup.js"></script>
    <title>Task Manager</title>
</head>

<body class="<?php echo $_COOKIE['theme']; ?>">

    <h1><?php echo $_SESSION["user"]; ?>'s Task Manager</h1><br>
    <button type="button" onclick="toggleTheme()" id="name">Light Mode</button>

    <form action="tasks.php">
        <input type="submit" value="Back">
    </form>

    <form action="import_tasks.php" method="POST" onsubmit="return pop_up_import()">
        <input type="submit" value="Import Selected Tasks" name="import_task" class="group">

        <input type="hidden" name="ids" id="ids">

        <h2>Tasks to Import</h2>

        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Due Date</th>
                <th>Import</th>
            </tr>
            <?php
            if (($output = curl_exec($handle))!==false) {
                $xml = simplexml_load_string($output);

                foreach($xml->task as $task)
                {
                    echo "<tr>";
                    echo "<td name='{$task->id}'>" . $task->id . "</td>";
                    echo "<td>" . $task->name . "</td>";
                    echo "<td>" . $task->due . "</td>";
                    echo "<td> <input type='checkbox'> </td>";
                    echo "</tr>";
                }
            } else {
                die("error");
            }
            ?>

        </table> <br>
    </form>

    <footer>
        <a href="logout.php" style="margin-left: 20px;">Click here</a> to log out
    </footer>
</body>
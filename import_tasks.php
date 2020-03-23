<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: verify_login.php");
    exit();
}

$username = $_SESSION["user"];
$ids = $_POST['ids'];

$db = mysqli_connect('emps-sql.ex.ac.uk', 'wc352', 'wc352', 'wc352', '3306');
if ($db->connect_error) {
    exit('Could not connect');
}

$url = "http://students.emps.ex.ac.uk/dm656/task.php/";
if (($handle = curl_init())===false) {
    echo 'Curl-Error: ' . curl_error($handle);
} else {
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_FAILONERROR, true);
}

//$tasks = str_replace("[", "", $tasks);
//$tasks = str_replace("]", "", $tasks);
//$tasks_array = explode(",", $tasks, 0);

foreach ($ids as $id)
{
    curl_setopt($handle, CURLOPT_URL, $url . $id);
    curl_setopt($handle, CURLOPT_HTTPGET, true);

    if (($output = curl_exec($handle))!==false) {
        $xml = simplexml_load_string($output);

        foreach($xml->task as $task)
            {
                $name = $task->name;
                $due = $task->due;
                $description = $task->description;
                $done = False;

                $query = "INSERT INTO tasks (username, title, description, due_date, done) VALUES('$username', '$name', '$description', '$due', '$done')";
                mysqli_query($db, $query);
            }
    }
}

header("location: tasks.php");
exit();


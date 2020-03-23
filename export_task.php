<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: verify_login.php");
    exit();
}

$data= '<?xml version="1.0"?>';
$data.= '<taskinfo>';
$data.= '<name>' . $_POST["title"] . '</name>';
$data.= '<due>' . $_POST["due_date"]  . '</due>';
$data.= '<description>' . $_POST["description"]  . '</description>';
$data.= '</taskinfo>';

$url = "http://students.emps.ex.ac.uk/dm656/add.php";
if (($handle = curl_init())===false) {
    echo 'Curl-Error: ' . curl_error($handle);
} else {
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_FAILONERROR, true);
}

curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
if (($output = curl_exec($handle))===false) {
    die("error");
} else {
    echo $output;
}

header("location: tasks.php");
exit();

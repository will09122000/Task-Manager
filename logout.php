<?php
session_start();
if (session_status()===PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
    header("location: login.php");
}
?>
<html>
<head>
    <title>Logout</title>
</head>
<body>
<p>You have successfully logged out!</p>
</body>
</html>

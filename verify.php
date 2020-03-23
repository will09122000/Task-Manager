<?php
session_start();

$username_errors = array();
$password_errors = array();
$other_errors = array();

$db = mysqli_connect('emps-sql.ex.ac.uk', 'wc352', 'wc352', 'wc352', '3306');

if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $_SESSION["username"] = $username;
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    if (empty($username))
        array_push($username_errors, "Username not set");

    if (!preg_match("/^[a-zA-Z ]*$/",$username))
        array_push($username_errors, "Username must only contain letters and whitespace");

    if (empty($password))
        array_push($password_errors, "Password not set");

    if (strlen($password) < 5 and !empty($password))
        array_push($password_errors, "Password too short (5 characters minimum)");

    if (!preg_match('/[\'^£$%&*(){}@#~!?<>,|=_+¬-]/', $password) and !empty($password))
        array_push($password_errors, "Password must have at least one symbol");

    if ((!preg_match("/[a-z]+/",$password) or !preg_match("/[A-Z]+/",$password)) and !empty($password))
        array_push($password_errors, "Password must have at least one lower case letter and one upper case letter");

    if (!preg_match("/[0-9]{1}/",$password) and !empty($password))
        array_push($password_errors, "Password must have at least one number");

    if (preg_match("/[ ]+/",$password) and !empty($password))
        array_push($password_errors, "Password must not contain whitespaces");

    if (strpos(strtolower($username), strtolower($password)) !== false)
        array_push($password_errors, "Password must not contain username");

    if ($password != $password_check and !empty($password))
        array_push($other_errors, "Passwords do not match");

    if (empty($username_errors) and empty($password_errors)) {
        $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                array_push($other_errors, "Username already exists");
                $_SESSION["other_errors"] = $other_errors;
            }
        } else {
            $salt = bin2hex(openssl_random_pseudo_bytes(10));
            $hash = md5($salt . $password);
            $query = "INSERT INTO users (username, password, salt) VALUES('$username', '$hash', '$salt')";
            mysqli_query($db, $query);
            session_start();
            $_SESSION['user'] = $username;
            header("location: tasks.php");
            exit();
        }
    } else {
        $_SESSION["username_errors"] = $username_errors;
        $_SESSION["password_errors"] = $password_errors;
    }
}

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $_SESSION["username"] = $username;
    $password = $_POST['password'];

    if(empty($username))
        array_push($username_errors, "Username not set");

    if(empty($password))
        array_push($password_errors, "Password not set");

    if (empty($username_errors) and empty($password_errors)) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {

            while ($row = mysqli_fetch_assoc($result)) {
                $salt = $row['salt'];
                $hash = $row['password'];
            }
            $password = md5($salt . $password);
            if ($password == $hash) {
                session_start();
                $_SESSION['user'] = $username;
                header("location: tasks.php");
                exit();
            } else {
                array_push($other_errors, "Incorrect Password");
                $_SESSION["other_errors"] = $other_errors;
            }
        } else {
        array_push($other_errors, "Incorrect Username");
        $_SESSION["other_errors"] = $other_errors;
        }
    } else {
        $_SESSION["username_errors"] = $username_errors;
        $_SESSION["password_errors"] = $password_errors;
    }
}

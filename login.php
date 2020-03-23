<?php
include('verify.php');
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="static/css/main.css">
    <link rel="stylesheet" type="text/css" href="static/css/theme.css">
    <link rel="stylesheet" type="text/css" href="static/css/styles.css">
    <script src="theme.js"></script>
    <title>Task Manager</title>
</head>

<body class="<?php echo $_COOKIE['theme']; ?>">
    <h1>Task Manager</h1>
    <button type="button" onclick="toggleTheme()" id="name">Dark Mode</button>
    <br>
    <div class="form">
        <form action="login.php" method="POST">
            <label>Username:</label><br>
            <input type="text" autofocus="autofocus" placeholder="Enter Username" value="<?php echo $username?>" name="username"><br>
            <?php $username_errors = isset($_SESSION["username_errors"]) ? $_SESSION["username_errors"] : ''; ?>
            <?php  if (!empty($username_errors)) : ?>
                <?php  if (count($username_errors) > 0) : ?>
                    <div class="error">
                        <?php foreach ($username_errors as $username_error) : ?>
                            <p class="error"><?php echo $username_error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>
            <?php  endif ?>

            <label>Password:</label><br>
            <input type="password" placeholder="Enter Password" name="password"><br>
            <?php $password_errors = isset($_SESSION["password_errors"]) ? $_SESSION["password_errors"] : ''; ?>
            <?php  if (!empty($password_errors)) : ?>
                <?php  if (count($password_errors) > 0) : ?>
                    <div class="error">
                        <?php foreach ($password_errors as $password_error) : ?>
                            <p class="error"><?php echo $password_error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>
            <?php  endif ?>

            <input type="submit" value="Sign In" name="login_user" class="form">
            <?php $other_errors = isset($_SESSION["other_errors"]) ? $_SESSION["other_errors"] : ''; ?>
            <?php  if (!empty($other_errors)) : ?>
                <?php  if (count($other_errors) > 0) : ?>
                    <div class="error">
                        <?php foreach ($other_errors as $other_error) : ?>
                            <p class="error"><?php echo $other_error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>
            <?php  endif ?>
        </form>
        <br>
        <a href="register.php"> <u>Create Account</u></a>

    </div>

</body>
</html>

<?php
session_unset()
?>
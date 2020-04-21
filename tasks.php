<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: login.php");
    exit();
}
$user = $_SESSION["user"];
$db = mysqli_connect('emps-sql.ex.ac.uk', 'wc352', 'wc352', 'wc352', '3306');
$title_query = "SELECT * FROM tasks WHERE username='$user'";
$result = mysqli_query($db, $title_query);
//$task = mysqli_fetch_assoc($result);
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
    <title>Task Manager</title>
</head>

<body class="<?php echo $_COOKIE['theme']; ?>">

    <h1><?php echo $_SESSION["user"]; ?>'s Task Manager</h1>
    <button type="button" onclick="toggleTheme()" id="name">Light Mode</button>

    <form action="new_task.php">
        <input type="submit" value="New Task" name="new_task">
    </form>

    <form action="get_tasks.php">
        <input type="submit" value="Import Tasks" name="import_task">
    </form>


    <h2><?php echo $_SESSION["user"]; ?>'s Tasks</h2>

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Done</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td> {$row['title']} </td>";
            echo "<td> {$row['description']} </td>";
            echo "<td> {$row['due_date']} </td>";
            if ($row['done'] == 0) {
                echo "<td id='{$row['id']}'> Not Done </td>";
                //echo "<td <img src='http://students.emps.ex.ac.uk/wc352/cross.png' alt='Not Done'></td>";
            } else {
                echo "<td id='{$row['id']}'> Done </td>";
                //echo "<td <img src='http://students.emps.ex.ac.uk/wc352/tick.png' alt='Done'></td>";
            }

            echo "<td> 
                        <form onsubmit=change_done('{$row['id']}')>
                            <input type='submit' value='Complete'>
                        </form>
                  </td>";

            echo "<td> 
                        <form action=\"new_task.php\" method=\"POST\">
                            <input type='hidden' name='id' value= '{$row['id']}'>
                            <input type='hidden' name='title' value= '{$row['title']}'>
                            <input type='hidden' name='description' value= '{$row['description']}'>
                            <input type='hidden' name='due_date' value= '{$row['due_date']}'>
                            <input type='submit' value='Edit' name='edit_task'>
                        </form>
                  </td>";
            echo "<td> 
                        <form action=\"verify_task.php\" method=\"POST\">
                            <input type='hidden' name='id' value= '{$row['id']}'>
                            <input type='submit' value='Delete' name='delete_task'>
                         </form>
                  </td>";
            
            echo "</tr>";
        }
        ?>

    </table> <br>

    <footer>
        <a href="logout.php" style="margin-left: 20px;"> Click here</a> to log out
    </footer>

</body>



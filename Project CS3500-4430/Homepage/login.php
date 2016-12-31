<?php
session_start();

$host='#';
$username = '#';
$password = '#';
$dbname = '#';

$conn = mysqli_connect($host, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../Styles/reset.css">
        <link rel="stylesheet" href="http://localhost:8888/Project CS3500-4430/bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="../Styles/home.css">
        <title>Homepage - Pokedex: Pokemon Tracker!</title>
    </head>
    <header>
        <h1>Pokedex: Pokemon Tracker!</h1>
    </header>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        $sql = "SELECT * FROM Trainer WHERE Username = '". $_POST['Username']."' and Password = '". sha1($_POST['Password'])."';";

        $qsql = $conn->query($sql);
        $count = 0;
        $username = '';
        $firstname = '';
        $lastname = '';
        $email = '';
        if($qsql->num_rows >0) {
            while($row = $qsql->fetch_assoc()) {
                $username = $row['Username'];
                $firstname = $row['TrainerFirstName'];
                $lastname = $row['TrainerLastName'];
                $email = $row['Email'];
                $count = 1;
            }
        }
        if($count == 1) {
            $_SESSION['Username'] = $username;
            $_SESSION['FirstName'] = $firstname;
            $_SESSION['LastName'] = $lastname;
            $_SESSION['Email']= $email;
            echo '<script type = "text/javascript">window.location = "http://localhost:8888/Project CS3500-4430/Body/main.php";</script>';
        } else {
            echo 'Username and Password information are incorrect, try again!';
        }
    }

    ?>
    <p id="createAccount" class="form-group-sm text-center">No Account - <a href="../CreateAccount/Account.php">Sign Up!</a></p>

    <body class="container">

        <form class="form-horizontal" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"accept-charset="UTF-8">
            <div class="form-group">

                <label for='Username' class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="Username" id = 'Username' required>
                </div>
            </div>
            <div class="form-group">
                <label for="Password" class="col-sm-2 control-label">Password</label>
                <div class="col-md-8">
                    <input class="form-control" type="Password" name="Password" id="Password" required>
                </div>
            </div>
            <div class="form-group-sm">
                <div class="col-sm-offset-2 col-sm-8">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Log in!</button>
                    <button class="btn btn-danger btn-lg btn-block" type="reset">Clear</button>
                </div>
            </div>
            <div class="container">
                <div class="form-group-sm">
                </div>
            </div>
        </form>

    </body>
</html>

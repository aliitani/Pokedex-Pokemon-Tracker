<?php
$host='#';
$username = '#';
$password = '#';
$dbname = '#';

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error) {
    die("Connection Failed: ". $conn->connect_error);
}
?>
<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/reset.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../Styles/done.css">
    <title>Sign up Done!</title>
</head>
<header class="container">
    <nav id="navbar" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a id="Title" class="navbar-brand" href="../Homepage/home.html">Pokedex: Pokemon Trainer!</a>
            </div>
        </div>
    </nav>
</header>

<body class="container">
    <div class="container" id="doneDiv">
        <?php
            session_start();
            $firstname = $_SESSION['FirstName'];
            $lastname = $_SESSION['LastName'];
            $username = $_SESSION['Username'];
            $password = $_SESSION['Password'];
            $email = $_SESSION['Email'];
            $users = 0;

            if ($firstname == '' || $lastname == '' || $username == '' || $password == '' || $email == '') {
                echo '<div class="container" id="EmptyEntry">
                        <p class="h2" style="color: red;">Information provided is not complete. 
                        <a class="h3" href="http://localhost:8888/Project CS3500-4430/CreateAccount/Account.php">Go back!</a>
                        </p>
                        </div>';
            } else {
                $sqlCount = "Select COUNT(TrainerID) from Trainer;";
                $qCount = $conn->query($sqlCount);

                if($qCount -> num_rows > 0) {
                    while ($row = $qCount->fetch_assoc()) {
                        $users = $row['COUNT(TrainerID)'];
                    }
                }

                $sqlCheckusername = "Select Username from Trainer where Username = '". $username ."';";
                $qCheckusername = $conn->query($sqlCheckusername);

                $sqlCheckEmail = "Select Email from Trainer where Email = '". $email ."'";
                $qCheckEmail = $conn->query($sqlCheckEmail);

                $newUser = 0;

                if($qCheckusername-> num_rows > 0) {
                    //an account with the same username and email exists.
                    while($row = $qCheckusername-> fetch_assoc()) {
                            if ($username == $row['Username']) {
                                echo '<div id="UserExists">
                                        <p class="h2">User Name already exists with another account!</p><br>
                                        <p class="h3"><a href="http://localhost:8888/Project CS3500-4430/CreateAccount/Account.php">Try again!</a></p>
                                        </div>';
                                $newUser = 1;
                            }
                    }
                } else if ($qCheckEmail-> num_rows > 0){
                    while($row = $qCheckEmail-> fetch_assoc()) {
                        if ($email == $row['Email']) {
                            echo '<div id="UserExists">
                                    <p class="h2">Email already exists with another account!</p><br>
                                    <p class="h3"><a href="http://localhost:8888/Project CS3500-4430/CreateAccount/Account.php">Try again!</a></p>
                                    </div>';
                            $newUser = 1;
                        }
                    }
                }
                if ($newUser == 0) {
                    $users++;
                    //its not created and you need to add it to the sql. Account Created.
                    $sqlInput = "INSERT INTO Pokedex.Trainer (TrainerID, Username, Password, TrainerFirstName, TrainerLastName, Email) VALUES (". $users .", '".$username."', '". sha1($password) ."', '". $firstname ."', '". $lastname ."', '". $email ."');";
                    $conn->query($sqlInput);
                    echo '<p class="h5">Done! <a href="http://localhost:8888/Project CS3500-4430/Homepage/login.php">Log In!</a></p>';
                }
            }
        ?>

    </div>


</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/reset.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../Styles/PokemonDB.css">

    <title>Create Account - Pokedex: Pokemon Tracker!</title>

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

<h2>Create Account!</h2>
<div class="container" id="createAccount">
    <?php
    session_start();
    include('ValidationResult.php');

    $firstValid = new ValidationResult( "", "", true);
    $lastValid = new ValidationResult( "", "", true);
    $usernameValid = new ValidationResult("", "", true);
    $emailValid = new ValidationResult( "", "", true);
    $pass1Valid = new ValidationResult( "", "", true);
    $pass2Valid = new ValidationResult( "", "", true);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $firstValid = ValidationResult::checkParameter('FirstName', '~^[a-zA-Z]{2,30}$~', 'Enter a valid first name please.');
        $lastValid = ValidationResult::checkParameter('LastName', '~^[a-zA-Z]{2,30}$~', 'Enter a valid last name please.');
        $usernameValid = ValidationResult::checkParameter('Username', '/(?=^.{3,20}$)^[a-zA-Z][a-zA-Z0-9]*[._-]?[a-zA-Z0-9]+$/', 'Enter a valid username please.');
        $emailValid = ValidationResult::checkParameter('Email', '~^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$~', 'Enter a valid email please.');
        $pass1Valid = ValidationResult::checkParameter('Password1', '~^[A-Za-z0-9!@#$%^$*()_]{6,20}$~', 'Enter a valid password please.');
        $pass2Valid = ValidationResult::checkParameter('Password2', '~^[A-Za-z0-9!@#$%^$*()_]{6,20}$~', 'Enter a valid password please.');

        if ($_POST['Password1'] != $_POST['Password2']) {
            $pass1Valid = new ValidationResult($_POST['Password1'], 'Error', 'Enter a valid password please.', false);
            $pass2Valid = new ValidationResult($_POST['Password2'], 'Error', 'Enter a valid password please.', false);
        }
        if ($emailValid->isValid() && $usernameValid->isValid() && $firstValid->isValid() && $lastValid->isValid() && $pass1Valid->isValid() && $pass2Valid->isValid()) {
            $_SESSION['FirstName'] = $_POST['FirstName'];
            $_SESSION['LastName'] = $_POST['LastName'];
            $_SESSION['Username'] = $_POST['Username'];
            $_SESSION['Email'] = $_POST['Email'];
            $_SESSION['Password'] = $_POST['Password1'];
            echo '<script>window.location = "done.php"</script>';
        }
    }?>

    <form class="form-horizontal" name='form' role="form" id='form' action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
        <div class="container">
            <h3 class="h3">Provide your information:</h3>
            <div class="container" id="HaveAccount">
                <p class="text-center h4">Do you have an account? <a href="http://localhost:8888/Project CS3500-4430/Homepage/login.php">Login!</a></p>
            </div>
            <hr>
        <div class="row">

            <div class="col-md-2 col-md-offset-4">
                <label for="FirstName">First Name: </label>
                <div class="form-group">
                    <input id="box" type="text" name="FirstName" placeholder="First Name" value="<?php echo $firstValid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$firstValid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>

            <div class="col-md-4">
                <label  for="LastName">Last Name: </label>
                <div class="form-group">
                    <input id="box" type="text" name="LastName" placeholder="Last Name" value="<?php echo $lastValid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$lastValid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>
            <div class="col-md-2 col-md-offset-4">
                <label for="UserName">Username: </label>
                <div class="form-group">
                    <input id="box" type="text" name="Username" placeholder="Username"  value="<?php echo $usernameValid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$usernameValid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="Password">Password: </label>
                <div class="form-group">
                    <input id="box" type="password" name="Password1" placeholder="Password"  value="<?php echo $pass1Valid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$pass1Valid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>
            <div class="col-md-2 col-md-offset-4">
                <label for="Password2">Confirm Password: </label>
                <div class="form-group">
                    <input id="box" type="password" name="Password2" placeholder="Confirm Password"  value="<?php echo $pass2Valid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$pass2Valid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>
            <div class="col-md-4">
                <label for="Email">Email: </label>
                <div class="form-group">
                    <input id="box" type="email" name="Email" placeholder="Email"  value="<?php echo $emailValid->getValue();?>" required>
                    <span><?php echo '<p style="color: #FF0000;">'.$emailValid->getErrorMessage().'</p>'; ?></span>
                </div>
            </div>
        </div>
        </div>

        <hr>
        <input class="btn btn-primary btn-lg btn-block" id="Submit" type="submit" name="Create!" placeholder="Sign UP" value="Create!">
        <button class="btn btn-danger btn-lg btn-block" type="reset">Clear</button>
    </form>
</div>
</body>
</html>

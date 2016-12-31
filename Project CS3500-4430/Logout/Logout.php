<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['Password']);
unset($_SESSION['Email']);
unset($_SESSION['FirstName']);
unset($_SESSION['LastName']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/reset.css">
    <link rel="stylesheet" href="http://localhost:8888/Project CS3500-4430/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="http://localhost:8888/Project CS3500-4430/Styles/home.css">
    <link rel="stylesheet" href="http://localhost:8888/Project CS3500-4430/Styles/logout.css">
    <title>Homepage - Pokedex: Pokemon Tracker!</title>
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
<div class="container">
    <h2>GoodBye!</h2>
    <h3 class="h3-sm">Go back to homepage <a href="../Homepage/home.html">here.</a></h3>
</div>
</html>

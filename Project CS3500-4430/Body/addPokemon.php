<?php
session_start();
include('../includes/DBconfig.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/reset.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../Styles/addPokemon.css">
    <title>Add a Pokemon!</title>
</head>
<header>
    <nav id="navbar" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a id="Title" class="navbar-brand" href="#">Pokedex: Pokemon Trainer!</a>
            </div>
            <button class="btn btn-warning navbar-btn"><a href="PokemonDB.php">View Entire List of Pokemons!</a></button>
            <a href="../Body/main.php" ><button type="button" class="btn btn-primary navbar-btn">Go Back!</button></a>

            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-danger navbar-btn"><a id="logout" href="../Logout/Logout.php">Log Out!</a></button></li>
            </ul>
        </div>
    </nav>
</header>
<body class="container">
        <div class="container">
         <form class="form-horizontal" method="get" action="main.php">
            <div class="row">
             <?php
            echo '<select class="col-md-offset-4 input-lg" name="SelectedPokemon">';
            echo '<option selected>Select your pokemon here</option>';
            $sqlPoke = "SELECT * from Pokemon;";
            $Qpoke = $conn->query($sqlPoke);
            if($Qpoke->num_rows>0) {
                while($row=$Qpoke->fetch_assoc()) {
                    echo '<option value="'.$row['Ndex'].'">'.$row["Name"].'</option>';
                }
            }
            echo '</select>';

            ?>
            </div>
             <br>
             <div class="container">
                <input id="button" class="btn btn-primary btn-lg btn-block input -lg" type="submit" value="Add"/>
             </div>
         </form>
        </div>
</body>
</html>


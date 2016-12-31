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
        <link rel="stylesheet" href="../Styles/main.css">
		<title>Pokedex: Pokemon Tracker!</title>
	</head>
    <header>
        <nav id="navbar" class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a id="Title" class="navbar-brand" href="#">Pokedex: Pokemon Trainer!</a>
                </div>
                <button class="btn btn-warning navbar-btn"><a href="PokemonDB.php">View Entire List of Pokemons!</a></button>
                <button class="btn btn-warning navbar-btn"><a href="addPokemon.php">Update Your Pokemon Table!</a></button>
                <ul class="nav navbar-nav navbar-right">
                    <li><button class="btn btn-danger navbar-btn"><a id="logout" href="../Logout/Logout.php">Log Out!</a></button></li>
                </ul>
            </div>
        </nav>
    </header>

    <h1>Welcome back <?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName'];?>!</h1>
    <body class="container">
    <h2>Your Pokemon Table.</h2>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>NDEX</th>
                    <th>Name</th>
                    <th>Type One</th>
                    <th>Type Two</th>
                    <th>Evolves From</th>
                    <th>Evolves To</th>
                    <th>Generation</th>
                    <th>Strong Against</th>
                    <th>Weak Against</th>
                </thead>
                <?php
                    $sqlId = "SELECT TrainerID from Trainer where Username ='".$_SESSION['Username']."';";
                    $qID = $conn->query($sqlId);
                    $TrainerID;
                    if($qID->num_rows>0) {
                        while($row=$qID->fetch_assoc()) {
                            $TrainerID = $row['TrainerID'];
                        }
                    }
                    if($_SERVER['REQUEST_METHOD'] == 'GET') {
                        $pokemon= $_GET['SelectedPokemon'];


                        $scoreID = 0;
                        $sqlCount = "select COUNT(ScoreID) from TrainerScore;";
                        $qCount = $conn->query($sqlCount);
                        if($qCount->num_rows>0) {
                            while($row=$qCount->fetch_assoc()) {
                                $scoreID = $row['COUNT(ScoreID)'];
                            }
                        }
                        $scoreID = $scoreID + 1;
                        $sqlId = "SELECT TrainerID from Trainer where Username ='".$_SESSION['Username']."';";
                        $qID = $conn->query($sqlId);
                        $TrainerID = 0;
                        if($qID->num_rows>0) {
                            while($row=$qID->fetch_assoc()) {
                                $TrainerID = $row['TrainerID'];
                            }
                        }
                        $sqlInput = "INSERT INTO Pokedex.TrainerScore (ScoreID, TrainerID, Ndex) VALUES (".$scoreID.", ".$TrainerID.", ".$_GET['SelectedPokemon'].");";
                        $conn->query($sqlInput);
                    }
                    $sqlUser = "SELECT * from Pokemon where Ndex IN (Select Ndex FROM TrainerScore where TrainerID = ".$TrainerID.") ORDER BY NDEX ASC;";
                    $qPoke = $conn->query($sqlUser);

                    if($qPoke->num_rows >0) {
                        while($row = $qPoke->fetch_assoc()) {
                            echo '<tr><td>'.$row['Ndex'].'</td>'.'<td><a href="#">'.$row['Name'].'</a></td><td>'.$row['TypeOne'].'</td><td>'.$row['TypeTwo'].'</td><td>'.$row['EvolvesFrom'].'</td><td>'.$row['EvolvesTo'].'</td><td>'.$row['Generation'].'</td><td>'.$row['StrongAgainst'].'</td><td>'.$row['WeakAgainst'].'</td>'.'</tr>';
                        }
                    } else {
                        echo '</table><p class="text-danger text-center">You dont have any Pokemons yet!</p>';
                    }
                ?>
            </table>
        </div>
    </div>
    </body>
</html>

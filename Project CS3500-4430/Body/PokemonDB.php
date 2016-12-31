<?php
$host='#';
$username = '#';
$password = '#';
$dbname = '#';

$conn = new mysqli($host, $username, $password, $dbname);

if(!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/reset.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../Styles/PokemonDB.css">
    <title>Pokedex: Pokemon Tracker!</title>
</head>
<header>
    <nav id="navbar" class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a id="Title" class="navbar-brand" href="main.php">Pokedex: Pokemon Trainer!</a>
            </div>
            <button class="btn btn-warning navbar-btn"><a href="addPokemon.php">Update Your Pokemon Table!</a></button>
            <a href="../Body/main.php" ><button type="button" class="btn btn-primary navbar-btn">Go Back!</button></a>
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-danger navbar-btn"><a id="logout" href="../Logout/Logout.php">Log Out!</a></button></li>
            </ul>
        </div>
    </nav>
</header>

<body class="container">
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
            $sqlpoke = "Select Ndex, Name, TypeOne, TypeTwo, EvolvesFrom, EvolvesTo, Generation, StrongAgainst, WeakAgainst from pokemon ORDER BY Ndex ASC;";
            $qPoke = $conn->query($sqlpoke);

            if($qPoke->num_rows >0) {
                while($row = $qPoke->fetch_assoc()) {
                    echo '<tr><td>'.$row['Ndex'].'</td>'.'<td><a href="#">'.$row['Name'].'</a></td><td>'.$row['TypeOne'].'</td><td>'.$row['TypeTwo'].'</td><td>'.$row['EvolvesFrom'].'</td><td>'.$row['EvolvesTo'].'</td><td>'.$row['Generation'].'</td><td>'.$row['StrongAgainst'].'</td><td>'.$row['WeakAgainst'].'</td>'.'</tr>';
                }
            }
            ?>
        </table>
        </div>
    </div>
</body>
<footer class="container text-center">All content is &copy; 1995-2016 Nintendo/Game Freak.</footer>
</html>


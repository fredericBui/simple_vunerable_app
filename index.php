<?php
include('config.php');

session_start();

if (isset($_SESSION['user_id'])) {
    echo "<h1>Bienvenue, " . $_SESSION['username'] . " !</h1>";
    echo "<a href='client.php'>Gérer les clients</a><br>";
    echo "<a href='logout.php'>Se déconnecter</a>";
} else {
    echo "<h1>Veuillez vous connecter ou vous inscrire</h1>";
    echo "<a href='login.php'>Se connecter</a><br>";
}
?>

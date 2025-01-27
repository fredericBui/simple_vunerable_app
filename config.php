<?php
// Charger les variables depuis le fichier .env
$dotenv = fopen(".env", "r");
$envVars = [];
while ($line = fgets($dotenv)) {
    $line = trim($line);
    if ($line && strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $envVars[$key] = $value;
    }
}
fclose($dotenv);

// Connexion à la base de données avec les variables d'environnement
$host = $envVars['DB_HOST'];
$user = $envVars['DB_USER'];
$pass = $envVars['DB_PASS'];
$dbname = $envVars['DB_NAME'];

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Charger les variables d'environnement depuis le fichier .env
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

// Connexion à MySQL (sans base de données spécifiée)
$host = $envVars['DB_HOST'];
$user = $envVars['DB_USER'];
$pass = $envVars['DB_PASS'];

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Créer la base de données si elle n'existe pas
$dbname = $envVars['DB_NAME'];
$query = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($query) === TRUE) {
    echo "Base de données créée avec succès ou déjà existante.<br>";
} else {
    echo "Erreur lors de la création de la base de données : " . $conn->error . "<br>";
}

// Sélectionner la base de données
$conn->select_db($dbname);

// Créer la table des utilisateurs
$query = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($query) === TRUE) {
    echo "Table des utilisateurs créée avec succès.<br>";
} else {
    echo "Erreur lors de la création de la table des utilisateurs : " . $conn->error . "<br>";
}

// Fermer la connexion
$conn->close();
?>

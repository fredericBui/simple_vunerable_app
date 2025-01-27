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

// Connexion à la base de données (sans spécifier de base de données pour créer la DB)
$host = $envVars['DB_HOST'];
$user = $envVars['DB_USER'];
$pass = $envVars['DB_PASS'];

$conn = new mysqli($host, $user, $pass);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Créer la base de données
$dbname = $envVars['DB_NAME'];
$query = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($query) === TRUE) {
    echo "Base de données créée avec succès ou déjà existante.<br>";
} else {
    echo "Erreur lors de la création de la base de données : " . $conn->error . "<br>";
}

// Sélectionner la base de données
$conn->select_db($dbname);

// Créer la table des clients
$query = "
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(15) NOT NULL
)";

if ($conn->query($query) === TRUE) {
    echo "Table des clients créée avec succès.<br>";
} else {
    echo "Erreur lors de la création de la table : " . $conn->error . "<br>";
}

// Fermer la connexion
$conn->close();
?>

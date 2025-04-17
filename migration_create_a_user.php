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
    echo "Base de données créée avec succès ou déjà existante.\n";
} else {
    echo "Erreur lors de la création de la base de données : " . $conn->error . "\n";
}

// Sélectionner la base de données
$conn->select_db($dbname);

// Créer la table des clients
$query = "INSERT INTO users (username, password) VALUES ('" . $envVars['SUPER_USER'] . "', '" . $envVars['SUPER_USER_PSW'] . "');";

if ($conn->query($query) === TRUE) {
    echo "Utilisateur créé avec succès.\n";
} else {
    echo "Erreur lors de la création de la table : " . $conn->error . "\n";
}

// Fermer la connexion
$conn->close();

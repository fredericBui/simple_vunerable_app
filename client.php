<?php
include('config.php');

// Vérifier si un utilisateur est déjà connecté
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fonction pour traiter les données d'un client
function ajouterClient($nom, $email, $telephone, $conn) {
    $query = "INSERT INTO clients (nom, email, telephone) VALUES ('$nom', '$email', '$telephone')";
    $conn->query($query);
}

function modifierClient($id, $nom, $email, $telephone, $conn) {
    $query = "UPDATE clients SET nom='$nom', email='$email', telephone='$telephone' WHERE id=$id";
    $conn->query($query);
}

function supprimerClient($id, $conn) {
    $query = "DELETE FROM clients WHERE id=$id";
    $conn->query($query);
}

// Gestion des différentes actions selon la méthode (GET ou POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'ajouter':
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                ajouterClient($nom, $email, $telephone, $conn);
                break;
            case 'modifier':
                $id = $_POST['id'];
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                modifierClient($id, $nom, $email, $telephone, $conn);
                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    supprimerClient($id, $conn);
}

// Récupérer tous les clients pour affichage
$query = "SELECT * FROM clients";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
</head>
<body>

<h1>Gestion des Clients</h1>

<!-- Formulaire d'ajout de client -->
<h2>Ajouter un Client</h2>
<form method="POST">
    <input type="hidden" name="action" value="ajouter">
    Nom: <input type="text" name="nom" required><br>
    Email: <input type="email" name="email" required><br>
    Téléphone: <input type="text" name="telephone" required><br>
    <input type="submit" value="Ajouter">
</form>

<h2>Liste des Clients</h2>
<ul>
    <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            <?php echo $row['nom']; ?> - <?php echo $row['email']; ?> - <?php echo $row['telephone']; ?>
            <a href="?modifier=<?php echo $row['id']; ?>">Modifier</a>
            <a href="?supprimer=<?php echo $row['id']; ?>">Supprimer</a>
        </li>
    <?php endwhile; ?>
</ul>

<?php
// Formulaire de modification si l'utilisateur veut modifier un client
if (isset($_GET['modifier'])) {
    $id = $_GET['modifier'];
    $query = "SELECT * FROM clients WHERE id=$id";
    $result = $conn->query($query);
    $client = $result->fetch_assoc();
?>
    <h2>Modifier Client</h2>
    <form method="POST">
        <input type="hidden" name="action" value="modifier">
        <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
        Nom: <input type="text" name="nom" value="<?php echo $client['nom']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $client['email']; ?>" required><br>
        Téléphone: <input type="text" name="telephone" value="<?php echo $client['telephone']; ?>" required><br>
        <input type="submit" value="Modifier">
    </form>
<?php } ?>
<button><a href='logout.php'>Se déconnecter</a></button>

</body>
</html>

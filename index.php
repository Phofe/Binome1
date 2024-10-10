<?php
// Configuration de la base de données
$servername = "localhost"; // ou l'adresse de votre serveur
$username = "root"; // votre nom d'utilisateur
$password = ""; // votre mot de passe
$dbname = "binome1"; // le nom de votre base de données

// Créer la connexion
$mysqli = new mysqli($servername, $username, $password, $dbname);


// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
}


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Échapper les données pour éviter les injections SQL
    // Vérification des clés avant de les utiliser
    $nom = $mysqli->real_escape_string($_POST['nom']);
    $prenoms = $mysqli->real_escape_string($_POST['prenoms']);
    $niveauEtude = $mysqli->real_escape_string($_POST['niveauEtude']);
    $universite = $mysqli->real_escape_string($_POST['universite']);
    $contact = $mysqli->real_escape_string($_POST['contact']);

    // Préparer la requête SQL pour insérer les données
    $sql = "INSERT INTO membres (nom, prenoms, niveau_etude, universite, contact)
            VALUES ('$nom', '$prenoms', '$niveauEtude', '$universite', '$contact')";

    // Exécuter la requête
    if ($mysqli->query($sql) === TRUE) {
        echo "Nouveau membre enregistré avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
$result = $mysqli->query("SELECT * FROM membres");

?>
    
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Inclure Font Awesome pour les icônes (facultatif) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <h1>Liste des Membres</h1>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Niveau d'Étude</th>
            <th>Université</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['prenoms'] . "</td>";
            echo "<td>" . $row['niveau_etude'] . "</td>";
            echo "<td>" . $row['universite'] . "</td>";
            echo "<td>" . $row['contact'] . "</td>";
            echo '<td>'
                .   '<form style="display:inline;" action="supprimer.php" method="Get">'
                . '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">'
                . '<input type="submit" name="supprimer" value="Supprimer">'
                . '</form>';
    
            // Formulaire pour modifier l'enregistrement
            echo '<form style="display:inline;" action="modifier.php" method="GET">'
                . '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">'
                . '<input type="submit" value="Modifier">'
                . '</form>';
            echo "</tr>";
        }
        ?>
    </table>
</body>


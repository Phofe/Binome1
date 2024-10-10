<?php
require_once 'index.php';
if (!isset($_GET['id'])) {
    echo "Aucun ID de personnage spécifié.";
    exit;
}

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validation de l'ID
if ($id === false) {
    echo "ID invalide.";
    exit;
}

// Préparer la requête SQL pour supprimer le membre
$requete = "DELETE FROM membres WHERE id = ?";
$statement = $mysqli->prepare($requete);
$statement->bind_param('i', $id); // Liaison du paramètre

// Exécuter la requête
if ($statement->execute()) {
    // Redirection vers la page d'accueil après la suppression
   
} else {
    // En cas d'erreur, afficher un message d'erreur
    echo "Erreur lors de la suppression du client : " . $statement->error;
}
?>
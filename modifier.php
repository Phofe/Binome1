<?php
require_once 'index.php';
if (isset($_POST['modifier'])) {
    // Valider et échapper les entrées
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // Convertir l'id en entier
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $prenoms = isset($_POST['prenoms']) ? trim($_POST['prenoms']) : '';
    $niveauEtude = isset($_POST['niveauEtude']) ? trim($_POST['niveauEtude']) : '';
    $universite = isset($_POST['universite']) ? trim($_POST['universite']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';

    // Vérifiez si toutes les informations requises sont remplies
    if ($nom && $prenoms && $niveauEtude && $universite && $contact && $id > 0) {
        $stmt = $conn->prepare("UPDATE membres SET nom=?, prenoms=?, niveau_etude=?, universite=?, contact=? WHERE id=?");

        if ($stmt) {
            $stmt->bind_param("sssssi", $nom, $prenoms, $niveauEtude, $universite, $contact, $id);
        
            if ($stmt->execute()) {
                echo "Enregistrement mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour : " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erreur lors de la préparation de la requête : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs requis.";
    }
}
?>
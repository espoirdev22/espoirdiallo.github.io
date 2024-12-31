<?php
// Appel du fichier de connexion à la base de données
require_once('../connexion_db/conn_db.php');

// Définition de la requête de sélection des candidats
$sql_candidat = "SELECT id_candidat, nom FROM candidats";
// Exécution de la requête
$query_candidat = mysqli_query($conn, $sql_candidat) or die(mysqli_error($conn));

// Définition de la requête de sélection des épreuves
$sql_epreuve = "SELECT id_epreuve, nom_epreuve FROM epreuve";
// Exécution de la requête
$query_epreuve = mysqli_query($conn, $sql_epreuve) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'insertion des résultats</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="traitement.js">
</head>
<body>
    <?php include "menu.php"; ?>

    <div class="container">
        <form action="ajoutnote_candidat.php" method="POST">
            <h2>Formulaire d'insertion des résultats</h2>
            
            <div class="field">
                <label for="id_candidat">Matricule:</label>
                <select id="id_candidat" name="id_candidat" required>
                    <option value="">Sélectionnez</option>
                    <?php
                    while ($cand= mysqli_fetch_assoc($query_candidat)) {
                        echo "<option value='" . $cand['id_candidat'] . "'>".$cand['id_candidat'] ."</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="field">
                <label for="id_epreuve">Nom de l'épreuve:</label>
                <select id="id_epreuve" name="id_epreuve" required>
                    <option value="">Sélectionnez</option>
                    <?php
                    while ($epreuve = mysqli_fetch_assoc($query_epreuve)) {
                        echo "<option value='" . $epreuve['id_epreuve'] . "'>" .$epreuve['nom_epreuve'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="field">
                <label for="note">Note:</label>
                <input type="number" id="note" name="note" min="0" max="20" step="0.1" required>
            </div>

            <div class="field">
                <input id="bouton" type="submit" name="submit_resultat" value="Enregistrer">
            </div>
        </form>
    </div>
</body>
</html>
<?php
// Appel du fichier de connexion à la base de données
require_once('../connexion_db/conn_db.php');
// Vérifiez si l'ID du candidat est passé dans l'URL
if (!isset($_GET['id_resultat'])) {
    die('ID du resultat non spécifié.');
}

$id = $_GET['id_resultat'];
// Définition de la requête de sélection des candidats
$sql_candidat = "SELECT id_candidat, nom FROM candidats";
// Exécution de la requête
$query_candidat = mysqli_query($conn, $sql_candidat) or die(mysqli_error($conn));

// Définition de la requête de sélection des épreuves
$sql_epreuve = "SELECT id_epreuve, nom_epreuve FROM epreuve";
// Exécution de la requête
$query_epreuve = mysqli_query($conn, $sql_epreuve) or die(mysqli_error($conn));
// Requête pour les informations du candidat
$sql_fiche = "SELECT * FROM resultat WHERE id_resultat='$id'";
$query_fiche = mysqli_query($conn, $sql_fiche) or die(mysqli_error($conn));

if ($fiche = mysqli_fetch_array($query_fiche)) {
    extract($fiche);
} else {
    die('Aucun resultat trouvé avec cet ID.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'insertion des résultats</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include "menu.php"; ?>

    <div class="container">
        <form action="modifresultat_candidat.php" method="POST">
            <h2>Formulaire d'insertion des résultats</h2>
            <div class="field">
                        <input type="hidden" name="id_resultat" value="<?= $id_resultat ?>">
                    </div>
            <div class="field">
                <label for="id_candidat">Matricule:</label>
                <select id="id_candidat" name="id_candidat" required>
                    <option value="">Sélectionnez</option>
                    <?php
                    while ($cand= mysqli_fetch_row($query_candidat)) {
                        echo "<option value=' $cand[0]' " . ($id_candidat == $cand[0] ? "selected" : "") . ">$cand[0]</option>";
                      
                    }
                    ?>
                </select>
            </div>
            
            <div class="field">
                <label for="id_epreuve">Nom de l'épreuve:</label>
                <select id="id_epreuve" name="id_epreuve" required>
                    <option value="">Sélectionnez</option>
                    <?php
                    while ($epreuve = mysqli_fetch_row($query_epreuve)) {
                        echo "<option value='$epreuve[0]' " . ($id_epreuve == $epreuve[0] ? "selected" : "") . ">$epreuve[1]</option>";
                       /* echo "<option value='$epreuve[0]' " . ($id_epreuve == $epreuve[0] ? "selected" : "") . ">$epreuve[1]</option>";*/
                    }
                    ?>
                </select>
            </div>

            <div class="field">
                <label for="note">Note:</label>
                <input type="number" id="note" name="note" min="0" max="20" step="0.1" value="<?php echo $note ?>">
            </div>

            <div class="field">
                <input id="bouton" type="submit" name="submit_resultat" value="Modifier">
            </div>
        </form>
    </div>
</body>
</html>

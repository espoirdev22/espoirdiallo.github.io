<?php
session_start();
if (!isset($_SESSION['login'])) { // Si la variable session n'a pas été créée
    header("location:index.php");
    exit();
}

// Connexion à la base de données
require_once('../connexion_db/conn_db.php');

// Vérifiez si l'ID du candidat est passé dans l'URL
if (!isset($_GET['id_candidat'])) {
    die('ID du candidat non spécifié.');
}

$id = $_GET['id_candidat'];

// Requête pour les centres
$sql_cent = "SELECT * FROM centre_examen";
$query_cent = mysqli_query($conn, $sql_cent) or die(mysqli_error($conn));

// Requête pour les filières
$sql_filie = "SELECT * FROM filieres";
$query_filie = mysqli_query($conn, $sql_filie) or die(mysqli_error($conn));

// Requête pour les informations du candidat
$sql_fiche = "SELECT * FROM candidats WHERE id_candidat='$id'";
$query_fiche = mysqli_query($conn, $sql_fiche) or die(mysqli_error($conn));

if ($fiche = mysqli_fetch_array($query_fiche)) {
    extract($fiche);
} else {
    die('Aucun candidat trouvé avec cet ID.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <link rel="stylesheet" href="../styleform.css">
</head>
<body>
    <?php include "menu.php"; ?>
    <main>
        <div class="container">
            <h2>Formulaire d'Inscription</h2>
            <p>Merci de remplir notre formulaire d'inscription pour participer aux examens d'entrée. Tous les champs avec * sont obligatoires.</p>
            <form action="modif_candidat.php" method="post" class="registration-form">
                <fieldset>
                    <legend>Informations Personnelles</legend>
                    <div class="form-group">
                        <input type="hidden" name="id_candidat" value="<?= $id_candidat ?>">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $nom ?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de Naissance:</label>
                        <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $date_naissance ?>">
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe:</label>
                        <select id="sexe" name="sexe">
                            <option value="">Sélectionnez</option>
                            <option value="m" <?php if ($sexe == "m") echo "selected"; ?>>Masculin</option>
                            <option value="f" <?php if ($sexe == "f") echo "selected"; ?>>Féminin</option>
                        </select>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Informations de Contact</legend>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= $email ?>">
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Informations sur le Centre</legend>
                    <div class="form-group">
                        <label for="centre">Centre d'Examen:</label>
                        <select id="centre" name="id_centre" required>
                            <option value="">Sélectionnez</option>
                            <?php
                            while ($cent = mysqli_fetch_row($query_cent)) {
                                echo "<option value='$cent[0]' " . ($id_centre == $cent[0] ? "selected" : "") . ">$cent[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Informations Académiques</legend>
                    <div class="form-group">
                        <label for="filiere">Filière:</label>
                        <select id="filiere" name="id_filiere" required>
                            <option value="">Sélectionnez</option>
                            <?php
                            while ($filie = mysqli_fetch_row($query_filie)) {
                                echo "<option value='$filie[0]' " . ($id_filiere == $filie[0] ? "selected" : "") . ">$filie[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </fieldset>
                
                <button type="submit" class="submit-button" name="bModif" value="Modifier">Modifier</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Institut Universitaire de Formation Professionnelle. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

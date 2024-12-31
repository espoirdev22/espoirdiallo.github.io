<?php
// Appel du fichier de connexion
require_once('connexion_db/conn_db.php');

// Définition de la requête
$sql_cent = "SELECT* FROM centre_examen";
$sql_filie = "SELECT* FROM filieres";

// Exécution de la requête pour le centre
$query_cent = mysqli_query($conn, $sql_cent) or die(mysqli_error($conn));

// Exécution de la requête pour les filières
$query_filie = mysqli_query($conn, $sql_filie) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <link rel="stylesheet" href="styleform.css">
</head>
<body>
    <?php include "menu.php"; ?>
    <main>
        <div class="container">
            <h2>Formulaire d'Inscription</h2>
            <p>Merci de remplir notre formulaire d'inscription pour participer aux examens d'entrée. Tous les champs avec * sont obligatoires.</p>
            <form action="ajoutcandidat.php" method="post" class="registration-form">
                <fieldset>
                    <legend>Informations Personnelles</legend>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de Naissance:</label>
                        <input type="date" id="date_naissance" name="date_naissance" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe:</label>
                        <select id="sexe" name="sexe" required>
                            <option value="">Sélectionnez</option>
                            <option value="masculin">Masculin</option>
                            <option value="feminin">Féminin</option>
                        </select>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Informations de Contact</legend>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone:</label>
                        <input type="tel" id="telephone" name="telephone" required>
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
                                echo "<option value='$cent[0]'>$cent[1]</option>";
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
                                echo "<option value='$filie[0]'>$filie[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dernier_diplome">Dernier Diplôme Obtenu:</label>
                        <input type="text" id="dernier_diplome" name="dernier_diplome" required>
                    </div>
                </fieldset>
                
                <button type="submit" class="submit-button">Soumettre</button>
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

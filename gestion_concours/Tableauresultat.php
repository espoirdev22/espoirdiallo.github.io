<?php  session_start();


// Connexion à la base de données
require_once('connexion_db/conn_db.php');

// Requête pour récupérer les résultats avec INNER JOIN
$sql = "
SELECT 
    c.id_candidat AS id_candidat,
    f.nom_filiere AS nom_filiere,  
    c.nom AS candidat_nom,
    c.prenom AS candidat_prenom,
    ce.nom_centre AS centre_nom,
    e.nom_epreuve AS nom_epreuve,
    r.note AS note
FROM 
    resultat r
    INNER JOIN candidats c ON r.id_candidat = c.id_candidat
    INNER JOIN centre_examen ce ON c.id_centre = ce.id_centre
    INNER JOIN filieres f ON c.id_filiere = f.id_filiere
    INNER JOIN epreuve e ON r.id_epreuve = e.id_epreuve
ORDER BY 
    c.nom, e.nom_epreuve
";

$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// Initialize arrays to store results for each level
$results_master = array();
$results_ingenieur = array();
$results_licence = array();

// Fetch results and store in arrays based on filiere
while ($row = mysqli_fetch_assoc($query)) {
    // Determine status based on the note
    if ($row['note'] < 10) {
        $row['statut'] = 'Non admis';
    } elseif ($row['note'] >= 10 && $row['note'] < 16) {
        $row['statut'] = 'Admis';
    } else {
        $row['statut'] = 'admis(excellent)';
    }

    // Classify the results into appropriate arrays
    switch ($row['nom_filiere']) {
        case 'Master':
       
            $results_master[] = $row;
            break;
        case 'Ingenieur':
        
            $results_ingenieur[] = $row;
            break;
        case 'Licence':
    
            $results_licence[] = $row;
            break;
    }
}

// Store results in session variables
$_SESSION['results_master'] = $results_master;
$_SESSION['results_ingenieur'] = $results_ingenieur;
$_SESSION['results_licence'] = $results_licence;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Concours</title>
    <link rel="stylesheet" href="styletable.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="container">
        <h2>Résultats des Concours</h2>

        <!-- Master Table -->
        <h3>Master</h3>
        <table class="table">
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Centre</th>
                <th scope="col">Épreuve</th>
                <th scope="col">Filière</th>
                <th scope="col">Note</th>
                <th scope="col">Statut</th>
            </tr>
            <?php
            if (isset($_SESSION['results_master']) && !empty($_SESSION['results_master'])) {
                foreach ($_SESSION['results_master'] as $row) {
                    $note_class = $row['note'] < 10 ? 'note-red' : '';
                    echo "<tr>
                        <td>{$row['id_candidat']}</td>
                        <td>{$row['candidat_nom']}</td>
                        <td>{$row['candidat_prenom']}</td>
                        <td>{$row['centre_nom']}</td>
                        <td>{$row['nom_epreuve']}</td>
                        <td>{$row['nom_filiere']}</td>
                        <td class='{$note_class}'>{$row['note']}</td>
                        <td>{$row['statut']}</td>
                    </tr>";
                }
            } else {
                echo '<tr><td colspan="8">Aucun résultat trouvé.</td></tr>';
            }
            ?>
        </table>

        <!-- Ingénieur Table -->
        <h3>Ingénieur</h3>
        <table class="table">
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Centre</th>
                <th scope="col">Épreuve</th>
                <th scope="col">Filière</th>
                <th scope="col">Note</th>
                <th scope="col">Statut</th>
            </tr>
            <?php
            if (isset($_SESSION['results_ingenieur']) && !empty($_SESSION['results_ingenieur'])) {
                foreach ($_SESSION['results_ingenieur'] as $row) {
                    $note_class = $row['note'] < 10 ? 'note-red' : '';
                    echo "<tr>
                        <td>{$row['id_candidat']}</td>
                        <td>{$row['candidat_nom']}</td>
                        <td>{$row['candidat_prenom']}</td>
                        <td>{$row['centre_nom']}</td>
                        <td>{$row['nom_epreuve']}</td>
                        <td>{$row['nom_filiere']}</td>
                        <td class='{$note_class}'>{$row['note']}</td>
                        <td>{$row['statut']}</td>
                    </tr>";
                }
            } else {
                echo '<tr><td colspan="8">Aucun résultat trouvé.</td></tr>';
            }
            ?>
        </table>

        <!-- Licence Table -->
        <h3>Licence</h3>
        <table class="table">
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Centre</th>
                <th scope="col">Épreuve</th>
                <th scope="col">Filière</th>
                <th scope="col">Note</th>
                <th scope="col">Statut</th>
            </tr>
            <?php
            if (isset($_SESSION['results_licence']) && !empty($_SESSION['results_licence'])) {
                foreach ($_SESSION['results_licence'] as $row) {
                    $note_class = $row['note'] < 10 ? 'note-red' : '';
                    echo "<tr>
                        <td>{$row['id_candidat']}</td>
                        <td>{$row['candidat_nom']}</td>
                        <td>{$row['candidat_prenom']}</td>
                        <td>{$row['centre_nom']}</td>
                        <td>{$row['nom_epreuve']}</td>
                        <td>{$row['nom_filiere']}</td>
                        <td class='{$note_class}'>{$row['note']}</td>
                        <td>{$row['statut']}</td>
                    </tr>";
                }
            } else {
                echo '<tr><td colspan="8">Aucun résultat trouvé.</td></tr>';
            }
            ?>
        </table>

    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}

// Connexion à la base de données
require_once('../connexion_db/conn_db.php');

// Récupérer les résultats pour toutes les filières
$sql = "
SELECT 
    r.id_resultat, 
    c.id_candidat, 
    c.nom AS candidat_nom, 
    e.nom_epreuve, 
    r.note, 
    f.nom_filiere 
FROM 
    resultat r 
    JOIN epreuve e ON r.id_epreuve = e.id_epreuve 
    JOIN candidats c ON r.id_candidat = c.id_candidat 
    JOIN filieres f ON c.id_filiere = f.id_filiere
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
        $row['statut'] = 'Admis (excellent)';
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
    <link rel="stylesheet" href="../styletable.css">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="container">
        <h2>Résultats des Concours</h2>

        <!-- Master Table -->
        <h3>Master</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Epreuve</th>
                <th>Note</th>
                <th>Statut</th>
                <th>Modification</th>
            </tr>
            <?php if (!empty($results_master)): ?>
                <?php foreach ($results_master as $resul): ?>
                    <tr>
                        <td><?= $resul['id_candidat'] ?></td>
                        <td><?= $resul['candidat_nom'] ?></td>
                        <td><?= $resul['nom_epreuve'] ?></td>
                        <td><?= $resul['note'] ?></td>
                        <td><?= $resul['statut'] ?></td>
                        <td><a href='fiche_resultat.php?id_resultat=<?= $resul['id_resultat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Aucun résultat trouvé.</td></tr>
            <?php endif; ?>
        </table>

        <!-- Ingénieur Table -->
        <h3>Ingénieur</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Epreuve</th>
                <th>Note</th>
                <th>Statut</th>
                <th>Modification</th>
            </tr>
            <?php if (!empty($results_ingenieur)): ?>
                <?php foreach ($results_ingenieur as $resul): ?>
                    <tr>
                        
                        <td><?= $resul['id_candidat'] ?></td>
                        <td><?= $resul['candidat_nom'] ?></td>
                        <td><?= $resul['nom_epreuve'] ?></td>
                        <td><?= $resul['note'] ?></td>
                        <td><?= $resul['statut'] ?></td>
                        <td><a href='fiche_resultat.php?id_resultat=<?= $resul['id_resultat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Aucun résultat trouvé.</td></tr>
            <?php endif; ?>
        </table>

        <!-- Licence Table -->
        <h3>Licence</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Epreuve</th>
                <th>Note</th>
                <th>Statut</th>
                <th>Modification</th>
            </tr>
            <?php if (!empty($results_licence)): ?>
                <?php foreach ($results_licence as $resul): ?>
                    <tr>
                        <td><?= $resul['id_candidat'] ?></td>
                        <td><?= $resul['candidat_nom'] ?></td>
                        <td><?= $resul['nom_epreuve'] ?></td>
                        <td><?= $resul['note'] ?></td>
                        <td><?= $resul['statut'] ?></td>
                        <td><a href='fiche_resultat.php?id_resultat=<?= $resul['id_resultat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Aucun résultat trouvé.</td></tr>
            <?php endif; ?>
        </table>

    </div>
</body>
</html>

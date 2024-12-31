<?php
session_start();
if (!isset($_SESSION['login'])) { // Si la variable session n'a pas été créée
    header("location:index.php");
    exit();
}

// Connexion à la base de données
require_once('../connexion_db/conn_db.php');

// Requêtes pour récupérer les candidats par filière
$sql_master = "SELECT id_candidat, nom, prenom, date_naissance, sexe, email, nom_centre, nom_filiere FROM candidats JOIN centre_examen USING(id_centre) JOIN filieres USING(id_filiere) WHERE nom_filiere = 'Master'";
$sql_ingenieur = "SELECT id_candidat, nom, prenom, date_naissance, sexe, email, nom_centre, nom_filiere FROM candidats JOIN centre_examen USING(id_centre) JOIN filieres USING(id_filiere) WHERE nom_filiere = 'Ingénieur'";
$sql_licence = "SELECT id_candidat, nom, prenom, date_naissance, sexe, email, nom_centre, nom_filiere FROM candidats JOIN centre_examen USING(id_centre) JOIN filieres USING(id_filiere) WHERE nom_filiere = 'Licence'";

$query_master = mysqli_query($conn, $sql_master);
$query_ingenieur = mysqli_query($conn, $sql_ingenieur);
$query_licence = mysqli_query($conn, $sql_licence);
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="ajout"><a href="inscrit_candidat.php">Ajouter</a></div> 
    <?php include "menu.php"; ?>
    <div class="container">
        <h2>Liste des candidats</h2>
      


        <!-- Master Table -->
        <h3>Master</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Naissance</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Centre</th>
                <th>Filière</th>
                <th>Modification</th>
                <th>Suppression</th>
            </tr>
            <?php while ($can = mysqli_fetch_array($query_master)): ?>
                <tr>
                    
                    <td><?= $can['id_candidat'] ?></td>
                    <td><?= $can['nom'] ?></td>
                    <td><?= $can['prenom'] ?></td>
                    <td><?= $can['date_naissance'] ?></td>
                    <td><?= $can['sexe'] ?></td>
                    <td><?= $can['email'] ?></td>
                    <td><?= $can['nom_centre'] ?></td>
                    <td><?= $can['nom_filiere'] ?></td>
                    <td><a href='fiche_candidat.php?id_candidat=<?= $can['id_candidat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href='supprime_candidat.php?id_candidat=<?= $can['id_candidat'] ?>' onclick="return confirm('Voulez-vous supprimer <?= $can['nom'] ?> ? Oui ou Non?');"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Ingénieur Table -->
        <h3>Ingénieur</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Naissance</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Centre</th>
                <th>Filière</th>
                <th>Modification</th>
                <th>Suppression</th>
            </tr>
            <?php while ($can = mysqli_fetch_array($query_ingenieur)): ?>
                <tr>
                    
                    <td><?= $can['id_candidat'] ?></td>
                    <td><?= $can['nom'] ?></td>
                    <td><?= $can['prenom'] ?></td>
                    <td><?= $can['date_naissance'] ?></td>
                    <td><?= $can['sexe'] ?></td>
                    <td><?= $can['email'] ?></td>
                    <td><?= $can['nom_centre'] ?></td>
                    <td><?= $can['nom_filiere'] ?></td>
                    <td><a href='fiche_candidat.php?id_candidat=<?= $can['id_candidat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href='supprime_candidat.php?id_candidat=<?= $can['id_candidat'] ?>' onclick="return confirm('Voulez-vous supprimer <?= $can['nom'] ?> ? Oui ou Non?');"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Licence Table -->
        <h3>Licence</h3>
        <table class="table">
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Naissance</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Centre</th>
                <th>Filière</th>
                <th>Modification</th>
                <th>Suppression</th>
            </tr>
            <?php while ($can = mysqli_fetch_array($query_licence)): ?>
                <tr>
                    <td><?= $can['id_candidat'] ?></td>
                    <td><?= $can['nom'] ?></td>
                    <td><?= $can['prenom'] ?></td>
                    <td><?= $can['date_naissance'] ?></td>
                    <td><?= $can['sexe'] ?></td>
                    <td><?= $can['email'] ?></td>
                    <td><?= $can['nom_centre'] ?></td>
                    <td><?= $can['nom_filiere'] ?></td>
                    <td><a href='fiche_candidat.php?id_candidat=<?= $can['id_candidat'] ?>'><i class="fa-duotone fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href='supprime_candidat.php?id_candidat=<?= $can['id_candidat'] ?>' onclick="return confirm('Voulez-vous supprimer <?= $can['nom'] ?> ? Oui ou Non?');"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

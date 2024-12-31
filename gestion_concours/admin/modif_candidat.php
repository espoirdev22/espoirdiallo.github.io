<?php
session_start();
if(!isset($_SESSION['login'])){ // Si la variable session n'a pas été créée
    header("location:index.php");
    exit();
}

// Appel du fichier de connexion
require_once('../connexion_db/conn_db.php');

// Récupération des données par la méthode POST
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$email = $_POST['email'];
$date_naissance = $_POST['date_naissance'];
$id_centre = $_POST['id_centre'];
$id_filiere = $_POST['id_filiere'];
$id = $_POST['id_candidat'];

// Définition de la requête de modification
$sql_update = "UPDATE candidats SET 
    nom = '$nom', 
    prenom = '$prenom', 
    date_naissance = '$date_naissance', 
    sexe = '$sexe', 
    id_filiere = '$id_filiere', 
    id_centre = '$id_centre', 
    email = '$email' 
WHERE id_candidat = '$id'";

// Exécution de la requête
$query_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));

header("location:liste_candidat.php");
exit();
?>

<?php
session_start();
if(!isset($_SESSION['login'])){// Si la variable session n'a pas été créée
    header("location:index.php");
    exit();
     }
//Appel du fichier de connexion
require_once('../connexion_db/conn_db.php');
//Récupération des données par post
$id_candidat=$_POST['id_candidat'];
$id_epreuve=$_POST['id_epreuve'];
$note=$_POST['note'];
//var_dump($_POST);

//Définition de la requête d'insertion
$sql_ajout="insert into resultat values(null,'$note',
        '$id_candidat','$id_epreuve')";
//Exécution de la requête
$query_ajout=mysqli_query($conn,$sql_ajout) or die(mysqli_error($conn));
header("location:liste_resultat.php");
exit();

?>
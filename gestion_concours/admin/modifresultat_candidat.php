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
$id = $_POST['id_resultat'];
//var_dump($_POST);
$sql_update = "UPDATE resultat SET 
    id_candidat = '$id_candidat', 
    id_epreuve = '$id_epreuve', 
    note = '$note' 
WHERE id_resultat = '$id'";
// Exécution de la requête
$query_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));
header("location:liste_resultat.php");
exit();

?>
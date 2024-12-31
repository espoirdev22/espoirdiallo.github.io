<?php
session_start();
if(!isset($_SESSION['login'])){//Si la variable session n'a pas été créee
    header("location:index.php");
    exit();
}
//Appel du fichier de connexion à la bd
require_once('../connexion_db/conn_db.php');
//Récupération de l'id par la méthode GET
$id=$_GET['id_candidat'];

//Définition de la requête de suppression
$sql_supprim="delete from candidats where id_candidat='$id'";
//Exécution de la requête
$query_supprim=mysqli_query($conn,$sql_supprim) or die(mysqli_error($conn));
//Redirection
header("location:liste_candidat.php");

?>
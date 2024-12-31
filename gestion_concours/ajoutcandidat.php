
<?php
session_start();
//Appel du fichier de connexion
require_once('connexion_db/conn_db.php');
//Récupération des données par post
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$sexe = $_POST['sexe'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$id_centre = $_POST['id_centre'];
$id_filiere = $_POST['id_filiere'];
$dernier_diplome = $_POST['dernier_diplome'];

//var_dump($_POST);  

//Définition de la requête d'insertion
$sql_ajout="insert into candidats values(null,'$nom',
        '$prenom','$date_naissance','$sexe','$telephone','$id_filiere','$id_centre','$email','$dernier_diplome ')";
//Exécution de la requête
$query_ajout=mysqli_query($conn,$sql_ajout) or die(mysqli_error($conn));


header("location:form_inscription.php");
exit();
?>

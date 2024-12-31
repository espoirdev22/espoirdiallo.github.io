<?php
session_start();
if(isset($_SESSION['login'])){//Si la variable session a �t� cr�ee
    header("location:liste_candidat.php");
    exit();
}
if(isset($_POST['Bconnexion'])){//SI on clique sur le bouton connexion
    //Appel du fichier de connexion � la bd
    require_once('../connexion_db/conn_db.php');
    //R�cup�ration des donn�es par la m�thode POST
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $mdpHash=sha1($mdp);
    //D�finition de la requ�te de selection
    $sql_auth="select count(*) nbl from admin where login='$login' and mdp='$mdpHash'";
    $query_auth=mysqli_query($conn,$sql_auth) or die(mysqli_error($conn));
    $auth=mysqli_fetch_object($query_auth);
    if($auth->nbl==1){//Si l'authentification est correcte
        //Cr�ation d'une variable session
        $_SESSION['login']=$login;
        header("location:liste_candidat.php");
        exit();
    }
    echo"<h3 style='text-align: center ; color:red'>MOt de passe ou longin incorrecte<h3>";
}
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="styleadmin.css">
    <link rel="stylesheet" href="../styles.css">
    
    
</head>
<body>
<?php include "menu.php"; ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<h2>Authentification</h2>
<div class="field">
    <label>Login</label>
    <input type="text" name="login">
</div>
<div class="field">
    <label>Mot de passe</label>
    <input type="password" name="mdp">
</div>
<div class="field">
    <input id="bouton" type="submit" name="Bconnexion" value="Connexion">
</div>
</form>

</body>
</html>
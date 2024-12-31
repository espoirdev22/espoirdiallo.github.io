<?php
// Start session
session_start();

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

    header("location:Tableauresultat.php");
    exit();
?>

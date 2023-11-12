<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}

// Assurez-vous que les paramètres d'URL sont des entiers
$idE = $_GET['idE'] ? intval($_GET['idE']) : 0;

// Supprimez l'enregistrement
$req = $bdd->prepare('DELETE FROM enregistrement WHERE idEnregistrement = ?');
$req->execute(array($idE));

// Vérifiez s'il y a des erreurs lors de l'exécution de la requête

// Conservez le paramètre 'ID' dans la redirection
$id=$_GET['id'];
$ID =$_GET['ID'];
header("location: enregistrement.php?id=$id&ID=$ID");
exit();
?>


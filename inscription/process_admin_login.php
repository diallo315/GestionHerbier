<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);
 
try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}

if (isset($_POST['mail']) && isset($_POST['pass'])) {
    $pass_hache = sha1('gz' . $_POST['pass']);
    $req = $bdd->query('SELECT * FROM agents');
    while ($donnees = $req->fetch()) {
        if ($pass_hache == $donnees['mot_pass'] && $_POST['mail'] == $donnees['email']) {
            $_SESSION['nom'] = $donnees['nom'];
            $_SESSION['prenom'] = $donnees['prenom'];
            $_SESSION['id_user'] = $donnees['id_utilisateur'];
            header("Location: ../index.php");
            exit;
        }
    }
    echo "Identifiants incorrects";
}else{ echo"Certains index ne sont pas definis dans\$_POST.";

}
?>

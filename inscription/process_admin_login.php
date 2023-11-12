<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["mail"]) && isset($_POST["password"])) {
        $mail = $_POST["mail"];
        $password = $_POST["password"];

        // Connect to the database
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('ERREUR : ' . $e->getMessage());
        }

        $query = "SELECT * FROM profil WHERE email = :mailProfil";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(":mailProfil", $mail);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['passwordProfil'])) {
                $_SESSION['mail'] = $row['email']; // assuming 'email' is the correct column name
                header('location: ../index.php');
                exit();
            } else {
                echo "Mot de passe incorrect";
                header("Location: model_inscription.php");
                exit();
            }
        }

        echo "Aucun utilisateur trouvé avec cet e-mail";
        header("Location: model_inscription.php");
        exit();
    } else {
        echo "Veuillez remplir tous les champs du formulaire";
        header("Location: model_inscription.php");
        exit();
    }
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["code_agent"]) && isset($_POST["passwordAgent"])) {
        $codeAgent = $_POST["code_agent"];
        $passwordAgent = $_POST["passwordAgent"];

        // Connect to the database
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('ERREUR : ' . $e->getMessage());
        }

        $query = "SELECT * FROM agent_profil WHERE code_agent = :codeAgent";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(":codeAgent", $codeAgent);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($passwordAgent, $row["passwordProfil"])) {
                $_SESSION['user'] = $row['id']; // You can store relevant user data in the session
                header("Location: ../agent_dashboard.php");
                exit();
            } else {
                echo "Mot de passe incorrect";
                header("Location: model_inscription.php");
                exit();
            }
        } else {
            echo "Aucun agent trouvé avec ce code";
            header("Location: model_inscription.php");
            exit();
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire";
        header("Location: model_inscription.php");
        exit();
    }
}
?>

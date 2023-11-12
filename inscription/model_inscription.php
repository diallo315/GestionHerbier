<?php
session_start(); // Démarrez la session avant d'accéder aux variables de session

try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["mail"]) && isset($_POST["password"])) {
        $mail = $_POST["mail"];
        $password = $_POST["password"];

        $query = "SELECT * FROM profil WHERE email = :mailProfil AND passwordProfil = :passwordProfil";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(":mailProfil", $mail);
        $stmt->bindParam(":passwordProfil", $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row["passwordProfil"])) {
                $_SESSION["idProfil"] = $row["idProfil"];
                $_SESSION["mailProfil"] = $row["mailProfil"];
                header("Location: ../index.php");
                exit(); // N'oubliez pas de terminer le script après une redirection header
            } else {
                echo "Mot de passe incorrect";
                header("location: mode_inscription.php");
                exit();
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet e-mail";
            header("location: model_inscription.php");
              exit();
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire";
        header("Location: model_inscription.php");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>Document</title>
</head>
<body>
  <div class="cotn_principal">
    <div class="cont_centrar">
    
      <div class="cont_login">
    <div class="cont_info_log_sign_up">
          <div class="col_md_login">
    <div class="cont_ba_opcitiy">
            
            <h2>ADMINISTRATEUR</h2>  
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
      <button class="btn_login btn-success" onclick="change_to_login()">CONNEXION</button>
      </div>
      </div>
    <div class="col_md_sign_up">
    <div class="cont_ba_opcitiy">
      <h2>AGENT DE TERRAIN</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    
      <button class="btn_sign_up" onclick="change_to_sign_up()">CONNEXION</button>
    </div>
      </div>
          </div>
    
        
        <div class="cont_back_info">
          <div class="cont_img_back_grey">
          <img src="images/image1.jpg" alt="" />
          </div>
          
        </div>
    <div class="cont_forms" >
        <div class="cont_img_back_">
          <img src="images/image1.jpg" alt="" />
          </div>
    <form action="" metho="post">
    <div class="cont_form_login">
    <a href="#" onclick="hidden_login_and_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
      <h2>ADMINISTRATEUR</h2>
        <input type="mail" placeholder="Exemple12@gmail.com" name="mail"/>
        <input type="password" placeholder="Password" name="password"/>
        <button type="submit" class="btn_login" onclick="change_to_login()">CONNEXION</button>
      </div>
    </form>
      <form action="" method="post">    
        <div class="cont_form_sign_up">
          <a href="#" onclick="hidden_login_and_sign_up()"><i class="material-icons mb-10">&#xE5C4;</i></a>
          <h2 style="margin-bottom: 0px; padding-top: 80px">AGENT DE TERRAIN</h2>
          <input type="text" placeholder="Entrez le code Agent" name="code_agent" />
          <input type="text" placeholder="Password" name="passwordAgent"/>
          <button type="submit" class="btn_sign_up btn-success" onclick="change_to_sign_up()">CONNEXION</button>
        </div>
    </form>
      
    
        </div>
        
      </div>
    </div>
    </div>
  <script src="assets/script.js"></script>
</body>
</html>
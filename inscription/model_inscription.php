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
    <form action="process_admin_login.php" method="post">
    <div class="cont_form_login">
    <a href="#" onclick="hidden_login_and_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
      <h2>ADMINISTRATEUR</h2>
        <input type="email" placeholder="Exemple12@gmail.com" name="mail"/>
        <input type="password" placeholder="Password" name="pass"/>
        <button type="submit" class="btn_login" onclick="change_to_login()">CONNEXION</button>
      </div>
    </form>
      <form action="process_agent_login.php" method="post">    
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
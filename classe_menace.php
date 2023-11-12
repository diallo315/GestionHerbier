<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['nom'])) {
        // Insertion des informations dans la table menaces
        $req = $bdd->prepare('INSERT INTO classemenace(idProtege, nomMenace) VALUES(?, ?)');
        $req->execute(array($_GET['id'], $_POST['nom']));

        // Rediriger pour éviter la resoumission du formulaire lors du rafraîchissement de la page
        header("Location: {$_SERVER['PHP_SELF']}?id={$_GET['id']}");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="CSS/bootstrap.css">
     <link rel="stylesheet" href="font-awesome/css/all.min.css">
     <title>Document</title>
</head>
<body>
<nav class="navbar" style="background-color: #e3f2fd; ">
  <div class="container-fluid">
    <a class="navbar-brand">Tableau de Bord</a>
    <form method="post" class="d-flex m-2" role="search">
	    <input class="form-control m-1 " type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success m-1" type="submit">Recherche</button>
      <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
     Ajouter
</button>
    </form>
      <!-- Button trigger modal -->

</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une Menace</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
      <div class="modal-body">
        <form action="" method="post">
          <div class="col-md-6 mb-2">
               <label for="nom">Nom de la Menace</label>
               <input type="text" id="nom" name="nom" class="form-control">
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
	   </form>
    </div>
  </div>
</div>
</nav>
<div class="row mt-5 justify-content-center">
     <div class ="">
     <a href="index.php" class="btn btn-danger m-3" >
     Retour
</a>
     <h1 class="text-center">Liste de classe Menaces</h1>
     </div>
  <?php 
  $donnees=$bdd->prepare('SELECT * FROM classemenace WHERE idProtege=?');
	 $donnees->execute(array($_GET['id']));
	 while($reponse=$donnees->fetch())	 
	 {
		
  ?>
  <div class="col-sm-2 mb-5 ">
    <div class="card">
      <div class="card-body ">
        <h5 class="card-title text-align-center"><?php echo $reponse['nomMenace']; ?></h5>
        
        <a href="enregistrement.php?id=<?php echo $reponse['idMenace']; ?>&ID=<?php echo $_GET['id']; ?>" class="btn btn-outline-success"><i class="fas fa-eye fa-sm"></i></a>	
		    <a href="modifier_menace.php?id=<?php echo $reponse['idMenace']; ?>&ID=<?php echo $_GET['id']; ?>" class="btn btn-outline-primary"><i class="fas fa-edit fa-sm"></i></a>
        <a href="supprimer_menace.php?id=<?php echo $reponse['idMenace']; ?>&ID=<?php echo $_GET['id']; ?>" class="btn btn-outline-danger"><i class="fas fa-trash fa-sm"></i></a>
      </div>
	  
    </div>
	
  </div>
  <?php
	 }
	 $donnees->closeCursor();
   ?>
 </div>
     
<script src="JS/bootstrap.bundle.min.js"></script>
</body>
</html>
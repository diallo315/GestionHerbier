<?php 
 
    try{
		$bdd=new PDO('mysql:host=localhost;dbname=herbier_db','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  }
	  catch(Exception $e){
		die('ERREUR : ' .$e->getMessage());
	  } 
	  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	  $query=$bdd->prepare('SELECT * FROM classemenace WHERE idMenace=?');
	  $query->execute(array($_GET['id']));
	  $donnees=$query->fetch();
	  }
	  
	  if(isset($_POST['nom']) ){
	  $req=$bdd->prepare('UPDATE classemenace SET nomMenace=:nomMenace WHERE idMenace=:idMenace');
	  $req->execute(array(
	      
	      'nomMenace'=>$_POST['nom'],
		  'idMenace'=>$_GET['id']
		  
	  ));
      $ID=$_GET['ID'];
	  header("location:classe_menace.php?id=$ID");
	 }
	  
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Modification de la menace</title>
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" class="bg-light p-4 rounded">
            <h2 class="text-center mb-4">Modification de la menace</h2>

            <div class="form-group">
                <label for="nom">Nom de la menace :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $donnees['nomMenace']; ?>" required />
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <p class="mt-2"><a href="classe_menace.php?id=<?php echo $_GET['ID'];?>" class="btn btn-secondary">Annuler</a></p>
        </form>
    </div>

    <script src="JS/bootstrap.bundle.min.js"></script>
</body>
</html>

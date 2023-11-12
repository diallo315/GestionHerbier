<?php 
 session_start();
    try{
		$bdd=new PDO('mysql:host=localhost;dbname=herbier_db','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  }
	  catch(Exception $e){
		die('ERREUR : ' .$e->getMessage());
	  }
	  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	  $query=$bdd->prepare('SELECT * FROM aireprotege WHERE idProtege=?');
	  $query->execute(array($_GET['id']));
	  $donnees=$query->fetch();
	  }
	  if(isset($_POST['nom']) AND isset($_POST['description']) AND isset($_POST['date'])){
	  $req=$bdd->prepare('UPDATE aireprotege SET nomProtege=:nomProtege,dateEvaluation=:dateEvaluation,description=:description WHERE idProtege=:idProtege');
	  $req->execute(array(
	      'idProtege'=>$_GET['id'],
	      'nomProtege'=>$_POST['nom'],
		  'dateEvaluation'=>$_POST['date'],
		  'description'=>$_POST['description'],
	  ));
	  header("location:index.php");
	 }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Modification du site</title>
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/all.min.css">

</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container">
        <form method="post" class="bg-light p-4">
            <h2 class="text-center mb-4">Modification du site</h2>

            <div class="form-group">
                <label for="nom">Nom du Site:</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $donnees['nomProtege']; ?>" required />
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required cols="50" rows="8"><?php echo $donnees['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date de l'évaluation:</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo $donnees['dateEvaluation']; ?>" required />
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <p class="mt-2"><a href="index.php" class="btn btn-secondary">Annuler</a></p>
        </form>
    </div>

    <script src="JS/bootstrap.bundle.min.js"></script>
</body>

</html>

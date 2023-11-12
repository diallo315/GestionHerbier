<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}
  if($_SERVER['REQUEST_METHOD']==='POST')
  {
	if (isset($_POST['nom1']) && isset($_POST['nom2']) ){
	 if (strtotime($_POST['date']) !== false && isset($_POST['description_activites']) && isset($_POST['zone']) && isset($_POST['date']) && isset($_POST['coordonnees']) && isset($_POST['habitat']) && isset($_POST['coordonnees']) && isset($_POST['score']) && isset($_POST['calendrier']) && isset($_POST['mesures_attenuations'])) {
        $a=intval($_POST['score']);
		$b=intval($_POST['calendrier']);
        $niveau =$a * $b; 
		
$req = $bdd->prepare('INSERT INTO enregistrement(idMenace,nomClasse1,nomClasse2,dateEnregistrement,coordonnees,niveauImpact,zone,habitat, descriptionActivite, mesureAttenuation)
     VALUES(:idMenace,:nomClasse1,:nomClasse2,:dateEnregistrement,:coordonnees,:niveauImpact,:zone,:habitat,:descriptionActivite,:mesureAttenuation)');

        $req->execute(array(
            'idMenace' => $_GET['id'],
            'nomClasse1' => $_POST['nom1'],
            'nomClasse2' => $_POST['nom2'],
            'dateEnregistrement' => $_POST['date'],
            'coordonnees' => $_POST['coordonnees'],
            'niveauImpact' => $niveau,
            'zone' => $_POST['zone'],
            'habitat' => $_POST['habitat'],
            'descriptionActivite' => $_POST['description_activites'],
            'mesureAttenuation' => $_POST['mesures_attenuations']
        ));
		if (!$req) {
           print_r($req->errorInfo());
    }
		
	 }else {
    // Gérez l'erreur de date invalide ici
	 echo "La date n'est pas valide.";}
	
    $ID = $_GET['ID'];
     $id = $_GET['id'];
    header("location:enregistrement.php?id=$id&ID=$ID");
    }	
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <title>Ajout d'un enregistrement</title>
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-12">
            <div class="row-3">
                <div class="card">
                    <div class="card-header ">
                        <h4>Ajout d'un enregistrement</h4>
                        <a href="enregistrement.php?id=<?php echo $_GET['id'];?>&ID=<?php echo $_GET['ID'];?>" class="btn btn-danger float-end">Retour</a>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6 mb-2">
                                <label>Sous Classe 1</label>
                                <input type="text" name="nom1" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Sous Classe 2</label>
                                <input type="text" name="nom2" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Zone/Localité</label>
                                <input type="text" name="zone" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Date d'enregistrement</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Coordonnées</label>
                                <input type="text" name="coordonnees" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Habitat</label>
                                <input type="text" name="habitat" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Description des activités</label>
                                <textarea name="description_activites" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Score de risque</label>
                                <select class="form-select" aria-label="Choisissez un score" name="score" id="score">
                                    <option>Choisissez une option</option>
                                    <option value="1">Faible</option>
                                    <option value="2">Moyen</option>
                                    <option value="3">Élevé</option>
                                    <option value="4">Très Élevé</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Calendrier</label>
                                <select class="form-select" aria-label="Choisissez un score" name="calendrier" id="score">
                                    <option>Choisissez une option</option>
                                    <option value="1">Futur</option>
                                    <option value="2">Passé</option>
                                    <option value="3">En cours</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Mesures d'atténuations</label>
                                <textarea name="mesures_attenuations" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <button type="submit" class="btn btn-primary float-end" >Ajouter l'enregistrement</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php 
 session_start();
    try{
		$bdd=new PDO('mysql:host=localhost;dbname=herbier_db','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  }
	  catch(Exception $e){
		die('ERREUR : ' .$e->getMessage());
	  }
     if($_SERVER['REQUEST_METHOD']==='GET')
     {
          $donneesMenaces=$bdd->prepare('SELECT * FROM classemenace WHERE idMenace=?');
          $donneesMenaces->execute(array($_GET['id']));
          $donneesMenaceNom=$donneesMenaces->fetch();
     }
	 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/all.min.css">
    <style> 
        .highlight {
            background-color: greenyellow;
            font-weight: bold;
        }

        /* Ajoutez ces styles pour le tableau */
        table {
            width: 100%;
        }

        th, td {
            font-size: 12px; /* Ajustez la taille de la police selon vos besoins */
        }

        /* Ajoutez ces styles pour occuper toute la hauteur de l'écran */
        html, body, .container, .row, .card, .card-body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Menu</title>
</head>
<body>

<div class="container-fluid m-3">
    <div class="row p-0">
        <div class="col-md-12">
            <div class="card co h-100">
                <div class="card-header">
                    <h1 class="text-center">Détails des Enregistrements sur la menace <p class><?php echo $donneesMenaceNom['nomMenace'];?></p></h1>
                    <a href="ajout.php?id=<?php echo $_GET['id'];?>&ID=<?php echo $_GET['ID']; ?>" class="btn btn-outline-primary float-end mb-3">Ajouter un enregistrement</a>
                    <a href="classe_menace.php?id=<?php echo $_GET['ID']; ?>" class="btn btn-outline-danger float-start mb-5">Retour</a> 
                </div>
                <form method="GET" class="form-inline my-2 my-lg-3 mt-2">
                    <div class="d-flex">
                        <input class="form-control mr-sm-2" type="text" name="recherche" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success m-1" type="submit">Recherche</button>
                    </div>
                </form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>SOUS_CLASSE 1</th>
                                    <th>SOUS_CLASSE 2</th>
                                    <th>ZONE/LOCALITE</th>
                                    <th>DATE_ENREGISTREMENT</th>
                                    <th>COORDONNEES</th>
                                    <th>HABITAT</th>
                                    <th>DESCRIPTION_ACTIVITES</th>
                                    <th>NIVEAU D'IMPACT GLOBAL</th>
                                    <th>MESURES D'ATTENUATIONS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ajouter les données -->
                                <?php
                                    $donnees=$bdd->query('select * from enregistrement');
                                    while ($reponse = $donnees->fetch())
                                    {?>  
                                        <tr>
                                            <th><p class="card-text"><?php echo $reponse['nomClasse1']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['nomClasse2']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['zone']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['dateEnregistrement']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['habitat']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['habitat']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['descriptionActivite']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['niveauImpact']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['mesureAttenuation']; ?></p></th>
                                            <th><a href="modification.php?idE=<?php echo $reponse['idEnregistrement']; ?>&id=<?php echo $_GET['id']; ?>&ID=<?php echo $_GET['ID']; ?>" class="btn btn-outline-primary"><i class="fas fa-edit fa-sm"></i></a>
                                           <a href="supprimer_enreg.php?idE=<?php echo $reponse['idEnregistrement']; ?>&id=<?php echo $_GET['id']; ?>&ID=<?php echo $_GET['ID']; ?>" class="btn btn-outline-danger"><i class="fas fa-trash fa-sm"></i></a></th>
                                        </tr>
                                <?php
                                    }
                                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

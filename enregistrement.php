
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
                    <h1 class="text-center">Détails des Enregistrements sur la menace <p style="color:green;"><?php echo $donneesMenaceNom['nomMenace'];?></h1>
                    <a href="ajout.php?id=<?php echo $_GET['id'];?>&ID=<?php echo $_GET['ID']; ?>" class="btn btn-outline-primary float-end mb-3">Ajouter un enregistrement</a>
                    <a href="classe_menace.php?id=<?php echo $_GET['ID'];?>&id=<?php echo $_GET['ID']; ?>" class="btn btn-outline-danger float-start mb-5">Retour</a> 
                </div>
                <form method="GET" class="form-inline my-2 my-lg-0">
                    <div class="d-flex">
                        <input class="form-control mr-sm-23" type="text" name="recherche" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Recherche</button>
                    </div>
                </form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th>Sous Classe 1</th>
                                    <th>Sous Classe 2</th>
                                    <th>Zone/Localité</th>
                                    <th>Date Enregistrement</th>
                                    <th>Coordonnées</th>
                                    <th>Habibat</th>
                                    <th>Description d'activités</th>
                                    <th>Niveau d'Impact Global</th>
                                    <th>Mesure d'Atténuation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ajouter les données -->
                                    <?php $donnees=$bdd->prepare('SELECT * FROM enregistrement WHERE idMenace=?');
                                    $donnees->execute(array($_GET['id']));

                                    while ($reponse = $donnees->fetch())
                                    {?>  
                                        <tr>
                                            <th><p class="card-text"><?php echo $reponse['nomClasse1']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['nomClasse2']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['zone']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['dateEnregistrement']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['coordonnees']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['habitat']; ?></p></th>
                                            <th><p class="card-text"><?php echo $reponse['descriptionActivite']; ?></p></th>
                                            <?php 
                                                $niveauImpact = $reponse['niveauImpact'];
                                                if ($niveauImpact >= 1 && $niveauImpact <= 3) {
                                                    $couleur = 'lightgreen';
                                                } elseif ($niveauImpact >= 4 && $niveauImpact <= 6) {
                                                    $couleur = 'yellow';
                                                } elseif ($niveauImpact >= 7 && $niveauImpact <= 9) {
                                                    $couleur = 'red';
                                                } elseif ($niveauImpact >= 10 && $niveauImpact <= 12) {
                                                    $couleur = 'darkred';
                                                } else {
                                                    // Gérer le cas où la valeur n'est pas dans une des plages spécifiées
                                                    $couleur = 'black';
                                                }
                                            ?>
                                             <th style='background-color: <?php echo $couleur; ?>'></th>
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

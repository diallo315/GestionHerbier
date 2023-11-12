<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=herbier_db', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('ERREUR : ' . $e->getMessage());
}

// Traitement de la soumission du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['description']) && isset($_FILES['photo'])) {
    $nom = $_POST['nom'];
    $dateEvaluation = $_POST['date'];
    $description = $_POST['description'];
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $photoEncoded = base64_encode($photo);

    $req = $bdd->prepare('INSERT INTO aireprotege (nomProtege,dateEvaluation,description,photo) VALUES (:nomProtege, :dateEvaluation, :description, :photo)');
    $req->execute(array(
        'nomProtege' => $nom,
        'dateEvaluation' => $dateEvaluation,
        'description' => $description,
        'photo' => $photoEncoded
    ));

    header('location: index.php');
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
    <style>
    /* Assurez-vous que les styles ne perturbent pas l'affichage de l'image */
    img {
        max-width: 100%;  /* Cela permet à l'image de s'ajuster à la largeur du conteneur parent */
        height: 100%;     /* Cela maintient le rapport hauteur/largeur de l'image */
        display: block;   /* Évite des problèmes d'alignement liés à la disposition en ligne par défaut */
    }
</style>
</head>

<body>
    <nav class="navbar" style="background-color: #e3f2fd; ">
        <div class="container-fluid">
            <a class="navbar-brand">Tableau de Bord</a>
            <form class="d-flex m-2" role="search">
                <input class="form-control m-1 " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success m-1" type="submit">Recherche</button>
                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter</button>
            </form>
        </div>
    </nav>

    <!-- Modal d'ajout site -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout d'un site</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-md-6 mb-2">
                            <label>Nom du site</label>
                            <input type="text" name="nom" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Date d'evaluation</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <h1 class="text-center">Liste de sites</h1>
        <?php
        $donnees = $bdd->query('select * from aireprotege');
        while ($reponse = $donnees->fetch()) {
        ?>
        <div class="card mb-3 m-4" style="max-width: 540px;">
         <div class="row g-0">
            <div class="col-md-4">
            <img src="data:image/jpeg;base64,<?php echo $reponse['photo']; ?>" class="card-img-top" alt="Image du site">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h1 class="card-title"><?php echo $reponse['nomProtege']; ?></h1>
                <p class="card-text"><?php echo $reponse['description']; ?></p>
                <p class="card-text"><small class="text-body-secondary"> <h5>Date d'evaluation:  <?php echo $reponse['dateEvaluation']; ?></h5>   </small></p>
                <a href="classe_menace.php?id=<?php echo $reponse['idProtege']; ?>" class="btn btn-outline-success"><i class="fas fa-eye fa-lg"></i></a>
                <a href="Modifier_site.php?id=<?php echo $reponse['idProtege']; ?>" class="btn btn-outline-primary"><i class="fas fa-edit fa-lg"></i></a>
                <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?php echo $reponse['idProtege']; ?>">
                     <i class="fas fa-trash fa-lg"></i>
                </a>
                <div class="modal fade" id="confirmDeleteModal<?php echo $reponse['idProtege']; ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                       <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        <div class="modal-body">
                          Êtes-vous sûr de vouloir supprimer ce site ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a href="suppression.php?id=<?php echo $reponse['idProtege']; ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
           </div>
</div>
                
            </div>
            </div>
          </div>
        </div>
            
        <?php
        }
        ?>

    </div>


    <script src="JS/bootstrap.bundle.min.js"></script>
</body>

</html>

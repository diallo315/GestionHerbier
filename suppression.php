<?php 
 
    try{
		$bdd=new PDO('mysql:host=localhost;dbname=herbier_db','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  }
	  catch(Exception $e){
		die('ERREUR : ' .$e->getMessage());
	  } 
	 $req=$bdd->prepare('DELETE FROM aireprotege WHERE idProtege=?');
	 $req->execute(array( $_GET['id']));
	 header('location:index.php');
	 
?>
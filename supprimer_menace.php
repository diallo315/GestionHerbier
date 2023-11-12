<?php 
 
    try{
		$bdd=new PDO('mysql:host=localhost;dbname=herbier_db','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  }
	  catch(Exception $e){
		die('ERREUR : ' .$e->getMessage());
	  } 
	 $req=$bdd->prepare('DELETE FROM classemenace WHERE idMenace=?');
	 $req->execute(array( $_GET['id']));
	 $id=$_GET['ID'];
	 header("location:classe_menace.php?id=$id");
	 
?>
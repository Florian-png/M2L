<?php


if(isset($_GET['m2lMP']) && empty($_SESSION['user'])){
	$_SESSION['m2lMP']= $_GET['m2lMP'];
}


else if (isset($_POST['submitConnex'])) {
	// Demande connexion 
	if(Securite::isBaned($_SERVER['REMOTE_ADDR'])) {
		die("Vous avez été bannis et c'est franchement dommage :(");
	}
	if(!empty($_POST["login"]) && !empty($_POST["mdp"])){
		$login = Securite::nettoyage($_POST["login"]);
		$mdp =  Securite::nettoyage($_POST["mdp"]);

		$userDAO = new DaoUtilisateur();
		$user = $userDAO->login($login,$mdp);

		if($user != null ) {
			$_SESSION['m2lMP'] = ucfirst($_SESSION['user']['fonction']);
		} else {
			Securite::antiBruteForce();
			$_SESSION['m2lMP']="connexion";
			$info = $_SESSION['antb'] - 1;
			$_SESSION['message'] = ['type' => 'alert' , 'message' => "Attention ! Tentative n°" . $info  . " /3."];
		}
	}
	
} 


else if(empty($_SESSION['user'])) {
	$_SESSION['m2lMP']="accueil";
}


$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));


$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');

include_once dispatcher::dispatch($_SESSION['m2lMP']);




 
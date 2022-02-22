<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
<?php 
	
	if (isset($_POST['envoyer'])){
		if (!empty($_POST['auteur']) && !empty($_POST['titre']) && !empty($_POST['articles'])){
	// Etape 1 : Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms12;charset=utf8', 'root', 'root');
}//essai d'accès à la bdd




catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
    
}//declenche une exception et envoi un message d'erreur
	
		
	//Etape 2 : insertion d'un article dans table news
	$titre = $_POST['titre'];
	$articles = $_POST['articles'];
	$auteur = $_POST['auteur'];
	
	$requete = $pdo->prepare("INSERT INTO news(auteur,titre,articles) VALUES (?,?,?)" );
	//prepare pour eviter les injections sql
	
	$requete->execute(array($auteur, $titre, $articles));
	
	include_once 'affichernews.php';
}
	}
		
?>
</body>
</html>
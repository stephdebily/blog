<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
<h1><a href ="template.php">Retourner à la page d'accueil</a></h1>
<?php 
	// Etape 1 : Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms12;charset=utf8', 'root', 'root');
}//essai d'accès à la bdd

catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
    
}//declenche une exception et envoi un message d'erreur
	
	//var_dump($pdo);
	//debuggue envoi object PDO1
	
	//Etape 2 : recup les enreg de la table news et les stocker ds une var php
	
	$requete= "SELECT auteur,titre,articles,date_creation FROM news ORDER BY id DESC LIMIT 0,5";
	$reponse = $pdo->query($requete);
	
	//Etape 3 : afficher les valeurs qui sont ds la var $reponse
	
	while ($data=$reponse->fetch()){
		
		echo "Auteur :".$data['auteur']."<br/>";
		echo "Date de publication :".$data['date_creation']."<br/>";
		echo "<h1>".$data['titre']."</h1>";
		echo "<em>".$data['articles']."</em><br/>";
		echo '<p><a href =affichernews.php">Readmore<p/><br/>';
	}
	//fetch() recupere un tableau et stock sur date et garanti de passer à la ligne suivante
	
	
	?>
	
</body>
</html>
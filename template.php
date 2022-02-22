<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <!--<link rel="stylesheet" style="text/css" href ="style/style.css"/>
-->
</head> 
  
  
  <style type="text/css">

body{

    background-color: lightgreen;
    width: 80%;
}

    #flex-container{
       
        
        height: auto;
        align-items: center;
    }
    
    ul{
        list-style-type: none; 
        display: flex;
        justify-content: space-around;
        margin-left: 100px;
    }
     

    
    .news{
      display: inline-block;
      vertical-align: top;
      overflow: auto;
      
       width: 30%;
        height: 700px;
        margin-left: 5%;
        text-align:center;
        font-size: 12px;
        background-color: blanchedalmond;
        
        border: solid black 2px;
    }

    .forum{
        display: inline-block;
      vertical-align: top;
        width: 30%;
        height: 700px;
        margin-left: 5%;
        text-align: center;
        
        background-color: blanchedalmond;
       
        border: solid black 2px;
    }
    .chat{
        display: inline-block;
      vertical-align: top;
        width: 20%;
        text-align: center;
        height: 700px;
        margin-left: 5%;
        background-color: blanchedalmond;
        
        border: solid black 2px;
    }
  </style>

<header>
    <img/>
    <section class="login-container">
        <form action="" method="post">
            <input type="text" name="pseudo" placeholder="pseudo" required="required"/>
            <input type="password" name="Mot de passe" placeholder="Mot de passe" required="required"/>
            
            <button onclick="window.location.href = 'authentification.html';">Connexion</button>
            <button onclick="window.location.href = 'authentification.html';">Inscription</button>
        </form>
    </section>
</br>
    <ul>
        <li><a href="ajouternews.html">AJOUTER UNE NEWS</a></li><li><a href="ajoutercommentaire.html">Ajouter un commentaire dans le FORUM</a></li><li><a href="#chat">CHAT</a></li><li><a href="#admin">ADMIN</a></li>
    </ul>
</header>
<body>
<div id="flex-container">
<div class=news >
    <h1>NEWS</h1>
    <!--<script type="text/javascript" language="JavaScript" src="affichernews.php"></script>-->
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
		//echo '<p><a href ="affichernews.php">Readmore<p/><br/>';
	}
	//fetch() recupere un tableau et stock sur date et garanti de passer à la ligne suivante
	?>
    
</div>
<div class=forum>
    <a href="billets.php"><h1>FORUM</h1></a>
<p>Bienvenue dans le forum !!!!!!!!!!!</p>
</div>
<div class=chat>
    <h1>CHAT</h1>
    <p>Bienvenue dans le chat !!!!!!!!!!!</p>
    <button onclick="window.location.href = 'chat.php';">Connexion au chat</button>
</div>
</div>
</body>
</html>
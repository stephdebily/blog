<?php
// on teste si nos variables sont définies
if (isset($_POST['pseudo']) && isset($_POST['pwd'])) {

	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
                        
                    //TRAITEMENT SESSION
                    // Etape 1 : Connexion à la base de données
                  
                    try {

                    $bdd = new PDO('mysql:host=localhost;dbname=cms12;charset=utf8', 'root', 'root'/*array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false))*/);
                    
                    //  echo "Suucés d'accès à la BD <br/>";
                    }
                    catch (Exception $e)
                    {
                        die('Erreur : ' . $e->getMessage());
                    }

                   //récupération valeurs
                   $pseudo=$_POST['pseudo'];
                   $motpasse=$_POST['pwd'];
                   $pass_hache=sha1($_POST['pwd']);

                    //Insertion d'une nouvelle ligne

                    $sql="SELECT id FROM utilisateur WHERE pseudo =:pseudo AND pwd=:pass";
                    $req = $bdd->prepare($sql);
                    $req-> execute(array('pseudo'=> $pseudo,'pass'=> $pass_hache));
                    $resultat= $req ->fetch();
                   
                   
                    //Si identifiant non reconnu
                    if (!$resultat)
                    {
                        echo '<body onLoad="alert(\'Mauvais identifiant ou mauvais mot de passe !!\')">';
                        echo '<a href="authentification.html">Retour page d\'authentification</a>';
                    }
                    
                    else{

                        // on la démarre :)
                        session_start ();
                        // on enregistre les paramètres de notre visiteur comme variables de session ($pseudo et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
                        
                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        $_SESSION['pwd'] = $_POST['pwd'];
                        echo 'Vous êtes connecté !';
                        $req->closeCursor();

                        // on redirige notre visiteur vers la page principale
                        header ('location: template.html');
	
                    }
                        
}
else {
    echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		// puis on le redirige vers la page d'accueil
        echo "<script type=\"text/javascript\"> window.location='authentification.html' ;</script>";
    }


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>cours session</title>
<style>
    body{
    background-color: #e5b63b;
    text-align: center;
    font-family:'Century Gothic', 'ariane';
    border-radius: 15px;
    width: 90%;
    border: 2px solid white;
    margin: 0 auto;
    padding:5px;
    line-height: 25px;
    margin-top: 50px;
    }
    table{
        margin: 0 auto;
        width:70%;
        margin-top: 30px;
        margin-bottom: 50px;
        text-align: center;
    }
   
</style>


</body>
</html>

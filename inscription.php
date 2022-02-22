<?php
//TRAITEMENT COOKIE


// on teste si nos variables sont définies
if (isset($_POST['pseudo']) && isset($_POST['pwd']) && isset($_POST['Envoyer'])) {

	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
	
				// on la démarre :)
                session_start ();
                    // on enregistre les paramètres de notre visiteur comme variables de session ($pseudo et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
                    
                    
                        
                    //TRAITEMENT SESSION
                    // Etape 1 : Connexion à la base de données



                    try {

                        $bdd = new PDO('mysql:host=localhost;dbname=cms12;charset=utf8', 'root', 'root')/*array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false))*/;
                    
                    //  echo "Succés d'accès à la BD <br/>";
                    }
                    catch (Exception $e)
                    {
                        die('Erreur : ' . $e->getMessage());
                    }
                    
                    //récupération valeurs
                    $pseudo=$_POST['pseudo'];
                    $motpasse=$_POST['pwd'];
                    $verif_motpasse=$_POST['confpwd'];
                    $pass_hache=sha1($_POST['pwd']);
                    $vpass_hache=sha1($_POST['confpwd']);
                    
                    
                if($pass_hache==$vpass_hache)
                    {
                    //Insertion d'une nouvelle ligne

                    $sql="INSERT INTO utilisateur (pseudo,pwd) VALUES(?,?)";
                    $res = $bdd->prepare($sql);
                    $execution=$res-> execute(array($pseudo,$pass_hache));

                    $res->closeCursor();
 
		            // on redirige notre visiteur vers la page d'accueil
                    echo '<body onLoad="alert(\'Inscription Réussie! Veuillez vous authentifiez.\')">';
                   // puis on le redirige vers la page principale template.php
                    echo '<meta http-equiv="refresh" content="0;URL=template.php">';
                    
                    }
                else{
                    echo '<body onLoad="alert(\'Mot de passe Incorrect\')">';
                    // puis on le redirige vers la page d'authentification
                    echo '<meta http-equiv="refresh" content="0;URL=authentification.html">';
                }


}
else {
    echo '<body onLoad="alert(\'Membre non reconnu...............\')">';
		// puis on le redirige vers la page d'authentification
		echo '<meta http-equiv="refresh" content="0;URL=authentification.html">';
    }


?>
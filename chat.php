<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>chat</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <script type="text/javascript">

            function refreshChat(){
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                       let membersList = document.getElementById("auteur");
                       let membersList = document.getElementById("messages");
                            }
                        }
                                    
                xhr.open("GET", "chat.php", true);
                xhr.send("");
                setInterval ("refreshChat()",time);
            }
        </script>

    <body>
    
    <form action="chat_post.php" method="post">
        <p>
        <label for="auteur">Pseudo</label> : <input type="text" name="auteur" id="auteur" /><br />
        <label for="messages">Message</label> :  <input type="text" name="messages" id="messages" /><br />

        <input type="submit" value="Envoyer" />
	</p>
    </form>
<?php
// Connexion à la base de données
include('connexion_chat.php');
/*try
{
	$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
*/
// Récupération des 10 derniers messages
$reponse = $bdd->query("SELECT  DATE_FORMAT(Date_public_Mess,'%d-%m-%Y %Hh%imin')  AS datem ,auteur, messages FROM chat ORDER BY id DESC LIMIT 0,5");

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
	echo '<p>'.$donnees['datem'].' :<strong>' . htmlspecialchars($donnees['auteur']) . '</strong> : ' .nl2br( htmlspecialchars($donnees['messages'])) . '</p>';
}
$reponse->closeCursor();


// Suppression des données stockées depuis plus d'une heure
$select="DELETE * FROM chat WHERE Date_public_Mess > NOW() - 3600";

$resultat=mysql_query($select);

 
?>
    </body>
</html>
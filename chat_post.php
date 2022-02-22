<?php
// Connexion à la base de données
include('connexion_chat.php');

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO chat (auteur, messages, Date_public_Mess) VALUES(:p,:m,Now())');
$req->execute(array('p' =>$_POST['auteur'], 'm' =>$_POST['messages']));

// Redirection du visiteur vers la page du minichat
header('Location: chat.php');
?>
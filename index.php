<?php
require 'config.php';
session_start();
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: formulaire.html');
    exit;
}

// Connexion à la base de données
$db = connexion();

// Récupération de la liste des utilisateurs en ligne
$query = "SELECT username FROM users WHERE online = 1";
$result = mysqli_query($db, $query);

// Affichage de la liste des utilisateurs en ligne
echo '<h2>Utilisateurs en ligne</h2>';
echo '<ul>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li><a href="messages.php?username=' . $row['username'] . '">' . $row['username'] . '</a></li>';
}
echo '</ul>';

// Formulaire pour envoyer un message à un utilisateur spécifique
echo '<h2>Envoyer un message</h2>';
echo '<form action="send_message.php" method="post">';
echo '<input type="text" name="username" placeholder="Nom d\'utilisateur">';
echo '<textarea name="message" placeholder="Votre message"></textarea>';
echo '<input type="submit" value="Envoyer">';
echo '</form>';

?>

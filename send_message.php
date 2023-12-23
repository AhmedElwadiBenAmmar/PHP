<?php
session_start();

// Connexion à la base de données
$db = connexion();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Récupérez les informations sur le message
$to_user = mysqli_real_escape_string($db, $_POST['to_user']);
$message = mysqli_real_escape_string($db, $_POST['message']);
$from_user = $_SESSION['username'];

// Enregistrez le message dans la base de données
$query = "INSERT INTO messages (from_user, to_user, message) VALUES ('$from_user', '$to_user', '$message')";
mysqli_query($db, $query);

// Redirigez l'utilisateur vers la page de messages
header("Location: messages.php?username=$to_user");
exit;
?>

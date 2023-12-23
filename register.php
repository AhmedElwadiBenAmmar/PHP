<?php
require 'config.php';
session_start();

// Connexion à la base de données
// connexion();
// Vérifiez si le formulaire d'inscription a été soumis
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = mysqli_real_escape_string(connexion(), $_POST['username']);
    $password = mysqli_real_escape_string(connexion(), $_POST['password']);
    $email = mysqli_real_escape_string(connexion(), $_POST['email']);

    // Vérifiez si le nom d'utilisateur est déjà pris
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query(connexion(), $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<p class="error">Ce nom d\'utilisateur est déjà pris</p>';
    } else {
        // Ajoutez l'utilisateur à la base de données
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        mysqli_query(connexion(), $query);
        // Enregistrez le nom d'utilisateur en tant que variable de session
        $_SESSION['username'] = $username;
        // Mettez l'utilisateur en ligne
        $query = "UPDATE users SET online = 1 WHERE username = '$username'";
        mysqli_query(connexion(), $query);
        // Redirigez l'utilisateur vers la page d'accueil
        header('Location: index.php');
        exit;
    }
}
?>

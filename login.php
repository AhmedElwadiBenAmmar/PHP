<?php
session_start();

// Connexion à la base de données
$db = connexion();

// Vérifiez si le formulaire de connexion a été soumis
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Vérifiez si les informations d'identification sont correctes
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        // Enregistrez le nom d'utilisateur en tant que variable de session
        $_SESSION['username'] = $username;
        // Mettez l'utilisateur en ligne
        $query = "UPDATE users SET online = 1 WHERE username = '$username'";
        mysqli_query($db, $query);
        // Redirigez l'utilisateur vers la page d'accueil
        header('Location: index.php');
        exit;
    } else {
        // Affichez un message d'erreur
        echo '<p class="error">Nom d\'utilisateur ou mot de passe incorrect</p>';
    }
}
?>

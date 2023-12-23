<?php
session_start();

// Connexion à la base de données
$db =connexion();

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Récupérez le nom d'utilisateur de l'utilisateur avec qui discuter
$to_user = mysqli_real_escape_string($db, $_GET['username']);

// Récupérez les messages
$query = "SELECT * FROM messages WHERE (from_user = '{$_SESSION['username']}' AND to_user = '$to_user') OR (from_user = '$to_user' AND to_user = '{$_SESSION['username']}') ORDER BY id ASC";
$result = mysqli_query($db, $query);

// Mettez à jour l'état de lecture des messages
$query = "UPDATE messages SET is_read = 1 WHERE to_user = '{$_SESSION['username']}' AND from_user = '$to_user'";
mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h1>Messages avec <?php echo $to_user; ?></h1>
    <div class="messages">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $from_user = $row['from_user'];
                $message = $row['message'];
                $time = $row['time'];
                echo "<p><strong>$from_user</strong> à $time</p>";
                echo "<p>$message</p>";
            }
        } else {
            echo "<p>Aucun message</p>";
        }
        ?>
    </div>
    <form action="send_message.php" method="post">
        <input type="hidden" name="to_user" value="<?php echo $to_user; ?>">
        <textarea name="message" placeholder="Entrez votre message"></textarea>
        <input type="submit" value="Envoyer">
    </form>
    <p><a href="index.php">Retour à la liste des utilisateurs</a></p>
</div>
</body>
</html>

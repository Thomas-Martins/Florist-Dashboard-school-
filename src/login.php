<?php
session_start();
require_once("connexion.php");
$erreur ="";


// 1. Vérification que les champs ont une valeur et non un espace
if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])){
    
    $username = trim($_POST['username']);
    
    $sql = "SELECT `username`, `password` FROM user
            WHERE username = :user";
    $query = $db->prepare($sql);
    $query->execute([
      "user" => $username
    ]);

    $user = $query->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $pwd = $_POST['password']; // ce qui est fourni dans le formulaire
        $hashedpwd = $user['password']; // ce qui est sauvegarder dans la table user
        
        $_SESSION['is_loggedin'] = true;
        
        header('Location: accueil.php');
    } else {
      $erreur = " <p>Informations erronées</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fleuriste</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <header>
                <div class="left-header">
                    <h3>Ma Boutique Fleuriste</h3>
                    <img src="assets/img/flower-logo-png.webp" alt="logo" width="50px">
                </div>
                <a class="log-btn" href="../index.php">Page d'accueil</a>
            </header>
            <div class="container">
            <?= $erreur; ?>
                <form action="" method="POST">
                    <input type="text" name="username" placeholder="Login">
                    <input type="password" name="password" placeholder="Mot de Passe">
                    <input type="submit" name="submit" value="Se connecter">
                </form>
            </div>
        </main>
        <footer>
            <p>Copyright©2023 Designed by Thomas - ViaFormation</p>
        </footer>
    </body>
</html>
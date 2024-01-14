<?php
session_start();
if(empty($_SESSION['is_loggedin'])){
    header('Location: ./index.php');
}

require_once("../connexion.php");

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username  = trim($_POST['username']);
    // il faudrait faire un select dans la table user pour verifier que username
    // n'est pas déjà utilisé

    $hashedpwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql   = "INSERT INTO `user`(`username`, `password`) VALUE (:user, :pwd)";
    $query = $db->prepare($sql);
    $query->execute([
        "user" => $username,
        "pwd"  => $hashedpwd
    ]);

    header('Location: userGestion.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de Clients</title>
    <link rel="stylesheet" href="../../assets/css/styleclients.css">
</head>
<body>
    <header>
        <div class="left-header">
            <h3>Ma Boutique Fleuriste</h3>
            <img src="../../assets/img/flower-logo.png" alt="logo" width="50px">
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="../accueil.php">Accueil</a></li>
                <li><a href="../client/index.php">Listes des clients</a></li>
                <li><a href="../stock/stock.php">Stock des Fleurs</a></li>
                <li><a href="../commandes/listCommande.php">Commandes</a></li>
                <li><a href="../fournisseur/index.php">Fournisseurs</a></li>
                <li><a href="../user/userGestion.php">Utilisateurs</a></li>
                <li><a class="log-btn" href="../logout.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="POST">
            <div>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Mot de Passe">
            </div>
            <input type="submit" name="submit" value="Ajouter">
        </form>
    </main>
</body>
</html>
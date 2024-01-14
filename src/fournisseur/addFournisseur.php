<?php 
require_once('../connexion.php');
$erreur = "";


if (isset($_POST['submit'])) {
    
    if (isset($_POST['raison_social']) && !empty($_POST['raison_social'])) {
            
            $raison_social = htmlspecialchars(trim($_POST['raison_social']));
            $nom = htmlspecialchars(trim($_POST['nom'])) ;
            $prenom = htmlspecialchars(trim($_POST['prenom'])) ;
            $tel = htmlspecialchars(trim($_POST['tel']));


            $sql="INSERT INTO fournisseur(raison_social, nom, prenom, telephone) 
                  VALUES (:raison_social, :nom, :prenom, :telephone);";
            $query = $db->prepare($sql);
            $query->execute([
                'raison_social' => $raison_social,
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $tel,
            ]);
            header('Location:index.php');
    }
    else {
        $erreur = "<p class='error'> Vous n'avez pas renseigner tout les champs obligatoire</p>";
    }


}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Ajouter un Fournisseur</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
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
        <h1 class="title">Ajouter un Fournisseur</h1>
        <?= $erreur; ?>
        <div class="container">
            <form action="" method="POST">
                <div>
                    <input type="text" name="raison_social" id="raison_social" placeholder="Raison Social" required>
                </div>
                <div>
                    <input type="text" name="nom" id="nom" placeholder="Nom du contact">
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom du contact">
                </div>
                <div>
                    <input type="tel" name="tel" id="tel" placeholder="Numéro de Téléphone">
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Ajouter">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php 
require_once('../connexion.php');
$erreur = "";


if (isset($_POST['submit'])) {
    
    if (isset($_POST['couleur']) && !empty($_POST['couleur'])) {
            
            $couleur = htmlspecialchars(trim($_POST['couleur']));
            
            // Ajout d'une variéte de fleur
            $sqlCouleur="INSERT INTO couleur(libelle) VALUE (:couleur);";
            $queryCouleur = $db->prepare($sqlCouleur);
            $queryCouleur->execute([
                'couleur' => $couleur
            ]);
            
            // Ajout d'une fleur avec l'id couleur, l'id variete et le prix 




            header('Location:stock.php');
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
    <title>Ajouter une Variété</title>
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
        <h1 class="title">Ajouter une couleur</h1>
        <?= $erreur; ?>
        <div class="container">
            <form action="" method="POST">
                <div>
                    <input type="text" name="couleur" id="couleur" placeholder="Couleur" required>
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Ajouter">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
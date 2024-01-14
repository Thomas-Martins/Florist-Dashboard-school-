<?php

require_once("../connexion.php");

/* je renvois l'utilisateur à la page index s'il n'y a pas de parametre id dans l'url de la page */
if (!isset($_GET['id']) || intval($_GET['id']) == 0){
    header('Location:index.php');
}


$id = $_GET['id'];
/* requete pour récupérer les informations d'un client */
$sqlFournisseur = "SELECT * FROM fournisseur WHERE id_fournisseur = :id;";
$queryFournisseur = $db->prepare($sqlFournisseur);
$queryFournisseur->execute([
    'id' => $id
]);

$fournisseur = $queryFournisseur->fetch();

/* je renvois l'utilisateur à la page index si le client n'existe pas en base */
if ($fournisseur === false){
    header('Location:index.php');
}



$erreur = "";
if (isset($_POST['submit'])) {
    
    if (isset($_POST['raison_social']) && !empty($_POST['raison_social'])) {

        $raison_social = htmlspecialchars(trim($_POST['raison_social']));
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom'])) ;
        $tel = htmlspecialchars(trim($_POST['tel']));


        $sqlUpdate="UPDATE fournisseur
                SET raison_social = :raison_social, nom = :nom, prenom = :prenom, telephone = :telephone
                WHERE id_fournisseur = :id";
        $queryUpdate = $db->prepare($sqlUpdate);
        $queryUpdate->execute([
            "raison_social" => $raison_social,
            "nom" => $nom,
            "prenom" => $prenom,
            "telephone" => $tel,
            "id" => $id,
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
    <title>Modification Fournisseur</title>
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
        <h2 class="title">Modifier les informations de : <?= $fournisseur['raison_social']?></h2>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="container">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <?= $erreur; ?>
                <div>
                    <input type="text" name="raison_social" id="raison_social" value="<?= $fournisseur['raison_social']?>" required>
                </div>
                <div>
                    <input type="text" name="nom" id="nom" value="<?= $fournisseur['nom']?>">
                    <input type="text" name="prenom" id="prenom" value="<?= $fournisseur['prenom']?>">
                </div>
                <div>
                    <input type="tel" name="tel" id="tel" value="<?= $fournisseur['telephone']?>">
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Modifier">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
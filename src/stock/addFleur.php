<?php 
require_once('../connexion.php');
$erreur = "";

// On récupère la variete et l'id variete
$sqlvariete="SELECT * FROM variete";
$queryVariete = $db->prepare($sqlvariete);
$queryVariete->execute([]);
$varietes = $queryVariete->fetchAll();

// On récupére la couleur et l'id couleur
$sqlCouleur = "SELECT * FROM couleur"; 
$queryCouleur = $db->prepare($sqlCouleur);
$queryCouleur->execute([]);
$couleurs = $queryCouleur->fetchAll();

// On récupere fournisseurs et id_fournisseurs 
$sqlFournisseurs = "SELECT * FROM fournisseur"; 
$queryFournisseurs = $db->prepare($sqlFournisseurs);
$queryFournisseurs->execute([]);
$fournisseurs = $queryFournisseurs->fetchAll();

if (isset($_POST['submit'])) {
    if (isset($_POST['id_variete']) && !empty($_POST['id_variete'])
        && isset($_POST['id_couleur']) && !empty($_POST['id_couleur'])
        ) {
            $id_variete = $_POST['id_variete'];
            $id_couleur = $_POST['id_couleur'];
            $prix = $_POST['prix'];

            $sqlFleur = "INSERT INTO `fleur`(`id_variete`, `id_couleur`, `prix`) 
                         VALUES (:id_variete, :id_couleur, :prix); ";
            $queryFleur = $db->prepare($sqlFleur);
            $queryFleur->execute([
                'id_variete' => $id_variete,
                'id_couleur' => $id_couleur ,
                'prix' => $prix
            ]);
            

            $id_fournisseur = $_POST['id_fournisseur'];
            $stock = $_POST['stock'];

            $sqlFournisseur = "INSERT INTO `fournisseur_fleur`(`id_fleur`,`id_fournisseur`, `stock`) 
                               VALUES (:id_fleur, :id_fournisseur, :stock);";
            $queryFournisseur = $db->prepare($sqlFournisseur);
            $queryFournisseur->execute([
                'id_fleur' => $db->lastInsertId(),
                'id_fournisseur' => $id_fournisseur,
                'stock' => $stock
            ]);


            header('Location: stock.php');
    }
    else {
        $erreur = "<p class='error'> L'ajout à échoué. </p>";
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
        <h1 class="title">Ajouter une Fleur</h1>
        <?= $erreur; ?>
        <div class="container">
            <form action="" method="POST">
                <div>
                    <select name="id_variete" id="id_variete">
                      <?php foreach ($varietes as $variete) {?>
                        <option value="<?=$variete['id_variete']?>"><?= $variete['libelle']?></option>
                      <?php }?>
                    </select>
                    <select name="id_couleur" id="id_couleur">
                      <?php foreach ($couleurs as $couleur) {?>
                        <option value="<?=$couleur['id_couleur']?>"><?= $couleur['libelle']?></option>
                      <?php }?>
                    </select>
                    <select name="id_fournisseur" id="id_fournisseur">
                      <?php foreach ($fournisseurs as $fournisseur) {?>
                        <option value="<?=$fournisseur['id_fournisseur']?>"><?= $fournisseur['raison_social']?></option>
                      <?php }?>
                    </select>
                </div>
                <div>
                    <input type="text" name="prix" id="prix" placeholder="Prix Unitaire">
                    <input type="text" name="stock" id="stock" placeholder="Quantité">
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Ajouter">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
require_once('../connexion.php');
$erreur = "";


// $sql = "SELECT couleur.libelle as couleur, variete.libelle as variete,variete.img_url, SUM(stock) FROM fleur
//         INNER JOIN couleur ON fleur.id_couleur = couleur.id_couleur
//         INNER JOIN variete ON fleur.id_variete = variete.id_variete
//         INNER JOIN fournisseur_fleur ON fournisseur_fleur.id_fleur = fleur.id_fleur
//         GROUP BY fleur.id_fleur
//         ORDER BY variete.libelle ASC";
$sql = "SELECT variete.id_variete, variete.libelle as variete,
        GROUP_CONCAT(couleur.libelle) as couleurs, variete.img_url
        FROM fleur
        INNER JOIN variete ON fleur.id_variete = variete.id_variete
        LEFT JOIN couleur ON fleur.id_couleur = couleur.id_couleur
        LEFT JOIN fournisseur_fleur ON fournisseur_fleur.id_fleur = fleur.id_fleur
        GROUP BY variete.id_variete, variete.libelle, variete.img_url
        ORDER BY variete.libelle ASC;";
$query = $db->prepare($sql);
$query->execute();

$fleurs = $query->fetchAll();
// var_dump($fleurs);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Variétés</title>
    <link rel="stylesheet" href="../../assets/css/styleStock.css">
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
        <div class="container">
            <div class="title">
                <h1>Stock des Produits</h1>
            </div>
            <div>
                <a href="addVariete.php">Ajouter une variété</a>
            </div>
            <div>
                <a href="addCouleur.php">Ajouter une couleur</a>
            </div>
            <div>
                <a href="addFleur.php">Ajouter une fleur</a>
            </div>
            <div class="stock">
                <?php foreach ($fleurs as $fleur) { ?>
                    <div class="card">
                        <a href="viewStock.php?id=<?= $fleur['id_variete'] ?>"><img src="<?= $fleur['img_url'] ?>" alt="img_fleur" width="300px"></a>
                        <div class="info">
                            <h3><?= $fleur['variete'] ?></h3><br>
                            <!-- <p>Couleur : <?= $fleur['couleur'] ?></p>
                        <p>En stock : <?= $fleur['SUM(stock)'] ?></p><br> -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
</body>

</html>
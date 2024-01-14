<?php 
require_once("../connexion.php");

/* je renvois l'utilisateur à la page index s'il n'y a pas de parametre id dans l'url de la page */
if (!isset($_GET['id']) || intval($_GET['id']) == 0){
    header('Location:index.php');
}


$id = $_GET['id'];
/* requete pour récupérer les informations d'un client */
$sql = "SELECT * FROM fournisseur WHERE id_fournisseur = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$fournisseur = $query->fetch();

/* je renvois l'utilisateur à la page index si le client n'existe pas en base */
if ($fournisseur === false){
    header('Location:index.php');
}

/* requête pour récupérer les stock du fournisseur */
$sqlStock = "SELECT fournisseur_fleur.stock, variete.libelle as variete, couleur.libelle as couleur 
            FROM `fleur`
            INNER JOIN variete ON fleur.id_variete = variete.id_variete
            INNER JOIN couleur ON fleur.id_couleur = couleur.id_couleur
            INNER JOIN fournisseur_fleur ON fleur.id_fleur = fournisseur_fleur.id_fleur
            WHERE fournisseur_fleur.id_fournisseur = :id
            GROUP BY fournisseur_fleur.id_fleur; ";
$queryStock = $db->prepare($sqlStock);
$queryStock->execute([
    "id" => $id
]);

$stocks = $queryStock->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>informations Fournisseur</title>
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
        <div class="container">
            <div class="title">
                <h1>Informations Fournisseur</h1>
            </div>
            <section class="infos" >
                <h2><?= $fournisseur['raison_social'] ?></h2>
                <a href="editFournisseur.php?id=<?= $fournisseur['id_fournisseur']?>"><small>Modifier les informations du Fournisseur</small></a>
                <p>
                    Contact : <?= $fournisseur['prenom']." ".$fournisseur['nom'] ?><br>
                    <?= $fournisseur['telephone']; ?>
                </p>
            </section>
            <section>
                <h2>Stock</h2>
                <table class="tableau">
                    <thead>
                        <th>Variété</th>
                        <th>Couleur</th>
                        <th>Quantité</th>
                    </thead>
                    <tbody>
                        <?php foreach($stocks as $stock){ ?>
                            <tr>
                                <td><?= $stock['variete']?></td>
                                <td><?= $stock['couleur']; ?></td>
                                <td><?= $stock['stock']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>
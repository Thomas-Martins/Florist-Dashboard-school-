<?php 
require_once("../connexion.php");

/* je renvois l'utilisateur à la page index s'il n'y a pas de parametre id dans l'url de la page */
if (!isset($_GET['id']) || intval($_GET['id']) == 0){
    header('Location:stock.php');
}


$id = $_GET['id'];
/* requete pour récupérer l'ID */
$sql = "SELECT * FROM fleur WHERE id_variete = :id
        GROUP BY id_fleur;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);
$fleurVarietes = $query->fetch();


if ($fleurVarietes === false){
    header('Location:stock.php');
}


// var_dump($fleurs);
/* requête pour récupérer les infos par variete */
$sqlInfos = "SELECT couleur.libelle as couleur, variete.libelle as variete, SUM(stock) AS total, prix FROM fleur
             INNER JOIN couleur ON fleur.id_couleur = couleur.id_couleur
             INNER JOIN variete ON fleur.id_variete = variete.id_variete
             LEFT JOIN fournisseur_fleur ON fournisseur_fleur.id_fleur = fleur.id_fleur
             WHERE variete.id_variete = :id
             GROUP BY fleur.id_fleur
             ORDER BY variete.libelle ASC";
$queryCommandes = $db->prepare($sqlInfos);
$queryCommandes->execute([
    "id" => $id
]);

$varieteInfos = $queryCommandes->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infos Variétés</title>
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
        <div>
            <a href="stock.php">Retour aux variétés</a>
        </div>
        <div class="title">
            <h1><?= $varieteInfos[0]['variete']?></h1>
        </div>
        <table class="tableau">
            <thead>
                <th>Couleur</th>
                <th>Stock total</th>
                <th>Prix unitaire</th>
            </thead>
            <tbody>
                <?php foreach ($varieteInfos as $varieteInfo) { ?>
                <tr>
                    <td><?= $varieteInfo['couleur']?></td>
                    <td><?= $varieteInfo['total']?></td>
                    <td><a href=""><?= $varieteInfo['prix']?></a></td>
                </tr>
                <?php } ?> 
            </tbody>
        </table>
    </main>
</body>
</html>
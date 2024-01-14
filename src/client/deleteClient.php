<?php 
require_once("../connexion.php");

/* je renvois l'utilisateur à la page index s'il n'y a pas de parametre id dans l'url de la page */
if (!isset($_GET['id']) || intval($_GET['id']) == 0){
    header('Location:index.php');
}


$id = $_GET['id'];
/* requete pour récupérer les informations d'un client */
$sql = "SELECT * FROM client WHERE id_client = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$client = $query->fetch();

/* je renvois l'utilisateur à la page index si le client n'existe pas en base */
if ($client === false){
    header('Location:index.php');
}

/* requête pour récupérer les commandes du client */
$sqlCommandes = "SELECT commande.num_commande, commande.date_commande, SUM(prix) AS total FROM commande
    INNER JOIN client ON commande.id_client = client.id_client
    INNER JOIN ligne_commande ON commande.num_commande = ligne_commande.num_commande
    INNER JOIN fleur ON ligne_commande.id_fleur = fleur.id_fleur
    WHERE client.id_client = :id
    GROUP BY commande.num_commande;";

$queryCommandes = $db->prepare($sqlCommandes);
$queryCommandes->execute(["id" => $id]);

$commandes = $queryCommandes->fetchAll();


if (isset($_POST['submit']) && isset($_POST['id']) && intval($_POST['id']) != 0) {

    $id = intval(trim($_POST['id']));

    foreach ($commandes as $commande) {
       $sqlDeleteLignes = "DELETE FROM ligne_commande  WHERE num_commande = :num";
       $sqlDeleteCommande = "DELETE FROM commande  WHERE num_commande = :num";

       $queryDeleteLignes = $db->prepare($sqlDeleteLignes);
       $queryDeleteLignes->execute([
        "num" => $commandes['num_commande']
       ]);

       $queryDeleteCommande = $db->prepare($sqlDeleteCommande);
       $queryDeleteCommande->execute([
        "num" => $commandes['num_commande']
       ]);
    }


    $sqlDelete = "DELETE FROM client WHERE id_client = :id";
    $queryDelete = $db->prepare($sqlDelete);
    $queryDelete->execute(["id"=> $id ]);
    header('Location: index.php');
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
        <div class="container">
            <div class="title">
                <h1>Suppression du client</h1>
            </div>
            <section class="infos" >
            <h2><?= $client['prenom'] ." ". $client["nom"]; ?></h2>
            <a href="editClient.php?id=<?= $client['id_client']?>"><small>Modifier les informations personnelles du client</small></a>
            <a href="deleteClient.php?id=<?= $client['id_client']?>"><small>Supprimer le client</small></a>
                <p>
                    <?= $client['adresse']; ?><br>
                    <?= $client['code_postal'] . ' ' . $client['ville']; ?>
                </p>
                <?= $client['telephone']; ?>

                <form method="POST">
                    <input type="hidden" name="id" value="<?= $client['id_client']?>">
                    <input type="submit" name="submit" value="Supprimer">
                </form>
            </section>
            <section>
                <h2>Commandes</h2>
                <table class="tableau">
                    <thead>
                        <th>Date</th>
                        <th>Numéro</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php foreach($commandes as $commande){ ?>
                            <tr>
                                <td><?= date('j/m/y' , strtotime($commande['date_commande'])); ?></td>
                                <td><?= $commande['num_commande']; ?></td>
                                <td><?= $commande['total']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>
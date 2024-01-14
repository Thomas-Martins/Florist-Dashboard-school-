
<?php
require_once('../connexion.php');
$erreur = "";


$sql = "SELECT commande.date_commande,commande.num_commande, client.nom, client.prenom, client.adresse, client.code_postal,client.ville   
        FROM commande INNER JOIN client ON commande.id_client = client.id_client
        ORDER BY date_commande DESC 
        LIMIT 25";
$query = $db->prepare($sql);
$query->execute();

$commandes = $query->fetchAll();

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
                <h1>Liste des Commandes</h1>
                <a href="">Ajouter une commande</a>
            </div>
            <table class="tableau">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Numéro de la commande</th>
                        <th>Client</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($commandes as $commande){ ?>
                        <tr>
                            <td><a href="viewClient.php?id=<?= $client['id_client'] ?>"><?= $commande['date_commande']?></a></td>
                            <td><?= $commande['num_commande'] ?></a></td>
                            <td><?= $commande['prenom'].' '.$commande['nom'] ?><br></td>
                            <td><?= $commande['adresse']?></td>
                            <td><?= $commande['code_postal']." ".$commande['ville']?></td>
                            <!-- <td>
                                <a href="editClient.php?id=<?=$client['id_client']?>">Modifier</a>
                                <a href="deleteClient.php?id=<?=$client['id_client']?>">Supprimer</a>
                            </td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
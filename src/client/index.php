
<?php
require_once('../connexion.php');
$erreur = "";


$sql = "SELECT * FROM client ORDER BY nom ASC LIMIT 25";
$query = $db->prepare($sql);
$query->execute();

$clients = $query->fetchAll();
// var_dump($clients);

// foreach ($clients as $client) {
//     echo $client['nom']." ".$client['prenom']."\n";
// }

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
                <h1>Liste des Clients</h1>
                <a href="./addClient.php">Ajouter un client</a>
            </div>
            <table class="tableau">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Tél</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $client){ ?>
                        <tr>
                            <td><a href="viewClient.php?id=<?= $client['id_client'] ?>"><?= $client['nom'].' '.$client['prenom']?></a></td>
                            <td><?= $client['telephone'] ?></a></td>
                            <td><?= $client['adresse'].' ' ?><br></td>
                            <td><?= $client['code_postal'].' '.$client['ville']; ?></td>
                            <td>
                                <a href="editClient.php?id=<?=$client['id_client']?>">Modifier</a>
                                <a href="deleteClient.php?id=<?=$client['id_client']?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
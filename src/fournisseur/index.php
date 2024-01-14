
<?php
require_once('../connexion.php');
$erreur = "";


$sql = "SELECT * FROM fournisseur ORDER BY raison_social ASC LIMIT 25";
$query = $db->prepare($sql);
$query->execute();

$fournisseurs = $query->fetchAll();
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
    <title>Liste de Fournisseurs</title>
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
                <h1>Liste des Fournisseurs</h1>
                <a href="addFournisseur.php">Ajouter un Fournisseur</a>
            </div>
            <table class="tableau">
                <thead>
                    <tr>
                        <th>Raison Social</th>
                        <th>téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fournisseurs as $fournisseur){ ?>
                        <tr>
                            <td><a href="viewFournisseur.php?id=<?= $fournisseur['id_fournisseur'] ?>"><?= $fournisseur['raison_social']?></a></td>
                            <td><?= $fournisseur['telephone'] ?></a></td>
                            <td>
                                <a href="editFournisseur.php?id=<?=$fournisseur['id_fournisseur']?>">Modifier</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
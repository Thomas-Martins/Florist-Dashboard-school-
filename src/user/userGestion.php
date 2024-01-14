
<?php
require_once('../connexion.php');
$erreur = "";


$sql = "SELECT * FROM user 
        ORDER BY username ASC LIMIT 25";
$query = $db->prepare($sql);
$query->execute();

$users = $query->fetchAll();
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
                <h1>Gestion des utilisateurs</h1>
                <a href="addUser.php">Ajouter un client</a>
            </div>
            <table class="tableau">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user){ ?>
                        <tr>
                            <td><?= $user['username']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
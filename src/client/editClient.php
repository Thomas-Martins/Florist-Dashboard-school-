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



$erreur = "";
if (isset($_POST['submit'])) {
    
    if (isset($_POST['lname']) && !empty($_POST['lname'])
        && isset($_POST['fname']) && !empty($_POST['fname'])
        && isset($_POST['tel']) && !empty($_POST['tel'])
        && isset($_POST['id']) && intval($_POST['id']) != 0) {
            
            $id = intval(trim($_POST['id']));
            $nom = htmlspecialchars(trim($_POST['lname']));
            $prenom = htmlspecialchars(trim($_POST['fname'])) ;
            $tel = htmlspecialchars(trim($_POST['tel']));
            $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : null;
            $cp = isset($_POST['cp']) ? htmlspecialchars(trim($_POST['cp'])) : null;
            $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : null;




            $sqlUpdate="UPDATE client
                  SET nom = :nom, prenom = :prenom, telephone = :telephone, adresse = :adresse,
                      code_postal = :cp, ville = :ville
                  WHERE id_client = :id";
            $queryUpdate = $db->prepare($sqlUpdate);
            $queryUpdate->execute([
                "nom" => $nom,
                "prenom" => $prenom,
                "telephone" => $tel,
                "adresse" => $address,
                "cp" => $cp,
                "ville" => $city,
                "id" => $id,
            ]);
            header('Location:viewClient.php?id='.$id);
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
    <title>Modification client</title>
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
        <h2 class="title">Modifier les informations de : <?= $client['prenom']." ".$client['nom']?></h2>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="container">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <?= $erreur; ?>
                <div>
                    <input type="text" name="lname" id="lname" value="<?= $client['nom']?>" required>
                    <input type="text" name="fname" id="fname" value="<?= $client['prenom']?>" required>
                </div>
                <div>
                    <input type="tel" name="tel" id="tel" value="<?= $client['telephone']?>" required>
                </div>
                <div>
                    <input type="text" name="address" id="address" value="<?= $client['adresse']?>">
                </div>
                <div>
                    <input type="text" name="cp" id="cp" value="<?= $client['code_postal']?>">
                    <input type="text" name="city" id="city" value="<?= $client['ville']?>">
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Modifier">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
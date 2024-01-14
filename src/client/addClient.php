<?php 
require_once('../connexion.php');
$erreur = "";


if (isset($_POST['submit'])) {
    
    if (isset($_POST['lname']) && !empty($_POST['lname'])
        && isset($_POST['fname']) && !empty($_POST['fname'])
        && isset($_POST['tel']) && !empty($_POST['tel'])) {
            
            $nom = htmlspecialchars(trim($_POST['lname']));
            $prenom = htmlspecialchars(trim($_POST['fname'])) ;
            $tel = htmlspecialchars(trim($_POST['tel']));
            $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : null;
            $cp = isset($_POST['cp']) ? htmlspecialchars(trim($_POST['cp'])) : null;
            $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : null;




            $sql="INSERT INTO client(nom,prenom,telephone,adresse,code_postal,ville) VALUES (:nom, :prenom, :tel, :adresse, :cp, :ville);";
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'tel' => $tel,
                'adresse' => $address,
                'cp' => $cp,
                'ville' => $city,
            ]);
            header('Location:index.php');
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
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<header>
        <div class="left-header">
            <h3>Ma Boutique Fleuriste</h3>
            <img src="../../ßassets/img/flower-logo.png" alt="logo" width="50px">
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
        <h1 class="title">Ajouter un client</h1>
        <?= $erreur; ?>
        <div class="container">
            <form action="" method="POST">
                <div>
                    <input type="text" name="lname" id="lname" placeholder="Nom" required>
                    <input type="text" name="fname" id="fname" placeholder="Prénom" required>
                </div>
                <div>
                    <input type="tel" name="tel" id="tel" placeholder="Numéro de Téléphone" required>
                </div>
                <div>
                    <input type="text" name="address" id="address" placeholder="Numéro et nom de rue">
                </div>
                <div>
                    <input type="text" name="cp" id="cp" placeholder="Code Postal">
                    <input type="text" name="city" id="city" placeholder="Ville">
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Ajouter">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php

session_start();
if(empty($_SESSION['is_loggedin'])){
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fleuriste</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
            <header>
                <div class="left-header">
                    <h3>Ma Boutique Fleuriste</h3>
                    <img src="../assets/img/flower-logo.png" alt="logo" width="50px">
                </div>
                <a  class="log-btn" href="logout.php">Deconnexion</a>
            </header>
            <div class="container">
                <div class="menu">
                    <div class="clients">
                        <div class="section-card">
                            <a href="client/index.php"><img src="../assets/img/clients.jpg" alt="clients"></a>
                            <h2>Clients</h2>
                        </div>
                    </div>
                    <div class="stock">
                        <div class="section-card">
                            <a href="stock/stock.php"><img src="../assets/img/stock.jpg" alt="clients"></a>
                            <h2>Stock</h2>
                        </div>
                    </div>
                    <div class="commande">
                        <div class="section-card">
                            <a href="commandes/listCommande.php"><img src="../assets/img/commande.jpg" alt="clients"></a>
                            <h2>Commandes</h2>
                        </div>
                    </div>
                    <div class="fournisseur">
                        <div class="section-card">
                            <a href="fournisseur/index.php"><img src="../assets/img/fournisseur.jpg" alt="clients"></a>
                            <h2>Gestion des Fournisseurs</h2>
                        </div>
                    </div>
                    <div class="user">
                        <div class="section-card">
                            <a href="user/userGestion.php"><img src="../assets/img/commande.jpg" alt="clients"></a>
                            <h2>Gestion des Utilisateurs</h2>
                        </div>
                    </div>
                </div>
               <div class="actus">
                <h2>Informations Complémentaires</h2>
               </div>
        </main>
    </body>
</html>
<?php
// Inclusion des fichiers de configuration et de fonctions
include '../includes/config.php';  
include '../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition du jeu de caractères et du titre de la page -->
    <meta charset="UTF-8">
    <title>Ajouter Email</title>

    <!-- Lien vers la feuille de style Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Lien vers la feuille de style principale -->
    <link rel="stylesheet" href="../css/styles.css">

    <!-- Icônes de la page (favicons) pour différentes tailles d'écrans et appareils -->
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
    <!-- Lien vers la page d'accueil avec un logo cliquable -->
    <a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo Ajouter Email"></a>

    <!-- Bouton de retour à la page précédente -->
    <a href="../index.php" class="return-button"><i class="fa fa-arrow-right"></i></a>

    <!-- Section pour l'ajout d'un email -->
    <section class="cards">
        <h1 class="title">Ajouter Email</h1>

        <?php
        // Vérification que le formulaire a été soumis via la méthode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération de l'email soumis
            $email = $_POST["email"];
            
            // Appel de la fonction pour ajouter l'email dans le fichier approprié
            ajouter_email($email, valid_file, invalid_file); 
        }
        ?>

        <!-- Formulaire pour ajouter un email -->
        <div class="form">
            <form action="" method="post">
                <!-- Champ pour saisir l'email -->
                <input type="email" id="email" name="email" placeholder="Entrez un email" required>
                
                <!-- Bouton pour soumettre le formulaire -->
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </section>
</body>
</html>

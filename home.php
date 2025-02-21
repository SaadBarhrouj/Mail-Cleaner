<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définition du jeu de caractères pour la page -->
    <meta charset="UTF-8">

    <!-- Assure que la page est bien adaptée aux écrans mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre de la page -->
    <title>MailCleaner</title>

    <!-- Lien vers la feuille de style Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Lien vers la feuille de style principale -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Icônes de la page (favicons) pour différentes tailles d'écrans et appareils -->
    <link rel="apple-touch-icon" sizes="180x180" href="includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="includes/site.webmanifest">
</head>
<body>
    <!-- Lien vers la page d'accueil avec un logo cliquable -->
    <a href="home.php" class="logo"><img src="images/logo.png" alt="Logo MailCleaner"></a>

    <div class="container">
        <div class="info">
            <!-- Titre principal -->
            <h1>Bienvenue sur MailCleaner</h1>

            <!-- Description du service -->
            <p>MailCleaner est une plateforme qui vous permet de trier et gérer vos emails en filtrant 
               les emails valides des invalides. Vous pouvez lire les emails depuis un fichier et 
               vérifier leur existence réelle. De plus, elle vous aide à ajouter de nouveaux emails 
               après avoir vérifié leur validité.
            </p>

            <!-- Bouton pour démarrer l'importation de fichiers -->
            <a href="importer_fichier.php" class="start-btn">Commencer <i class="fa fa-arrow-right"></i></a>
        </div>

        <div class="image">
            <!-- Image explicative de la plateforme -->
            <img src="images/image_1.png" alt="Image Explicative">
        </div>
    </div>
</body>
</html>

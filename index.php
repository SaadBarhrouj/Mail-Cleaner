<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition du jeu de caractères pour la page -->
    <meta charset="UTF-8">

    <!-- Assure que la page est bien adaptée aux écrans mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Lien vers la feuille de style Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Lien vers la feuille de style principale -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Titre de la page -->
    <title>Gestion des Emails</title>

    <!-- Icônes de la page (favicons) pour différentes tailles d'écrans et appareils -->
    <link rel="apple-touch-icon" sizes="180x180" href="includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="includes/site.webmanifest">
</head>
<body>
    <!-- Lien vers la page d'accueil avec un logo cliquable -->
    <a href="home.php" class="logo"><img src="images/logo.png" alt="Logo Gestion des Emails"></a>

    <!-- Bouton de retour à la page d'accueil -->
    <a href="importer_fichier.php" class="return-button">
        <i class="fa fa-arrow-right"></i>
    </a>

    <!-- Section des cartes d'options -->
    <section class="cards" id="cardsSection">
        <h2 class="title">Gestion des Emails</h2>

        <div class="content">
            <!-- Carte pour ajouter un email -->
            <div class="card">
                <div class="icon">
                    <a href="templates/ajouterEmail.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="info">
                    <h3>Ajouter un Email</h3>
                    <p>Ajouter une nouvelle adresse email à la liste des emails enregistrés.</p>
                </div>
            </div>

            <!-- Carte pour afficher les emails valides -->
            <div class="card">
                <div class="icon">
                    <a href="templates/emailsTable.php"><i class="fa fa-table"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Valides</h3>
                    <p>Voir toutes les adresses emails validées et leur fréquence d'utilisation.</p>
                </div>
            </div>

            <!-- Carte pour afficher les emails triés -->
            <div class="card">
                <div class="icon">
                    <a href="templates/emailsTableTriees.php"><i class="fa fa-sort"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Valides Triés</h3>
                    <p>Voir toutes les adresses emails triées et valides.</p>
                </div>
            </div>

            <!-- Carte pour afficher les emails par domaine -->
            <div class="card">
                <div class="icon">
                    <a href="templates/liste_domaines.php"><i class="fa fa-list-alt"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails par Domaine</h3>
                    <p>Voir toutes les adresses emails validées par domaine, et leur fréquence d'utilisation.</p>
                </div>
            </div>

            <!-- Carte pour afficher les emails vérifiés -->
            <div class="card">
                <div class="icon">
                    <a href="templates/emailsVerifieTable.php"><i class="fa fa-check-circle"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Vérifiés</h3>
                    <p>Voir toutes les adresses emails vérifiées et leur fréquence d'utilisation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Lien vers le fichier JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>

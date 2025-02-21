<?php
// Inclusion des fichiers de configuration et des fonctions
include '../includes/config.php'; 
include '../includes/functions.php';

// Vérification des emails valides et enregistrement dans le fichier des emails vérifiés
email_verify(valid_file, verified_file);

// Lecture des emails vérifiés depuis le fichier spécifié
$emails = lire_emails_simple(verified_file);

// Définition du nombre d'emails par page
$emails_par_page = 10;

// Calcul du nombre total de pages
$total_emails = count($emails);
$total_pages = ceil($total_emails / $emails_par_page);

// Récupération du numéro de page actuel
$page_actuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page_actuelle = ($page_actuelle > 0) ? $page_actuelle : 1;
$page_actuelle = ($page_actuelle > $total_pages) ? $total_pages : $page_actuelle;

// Calcul de l'index de début pour les emails à afficher sur la page actuelle
$index_debut = ($page_actuelle - 1) * $emails_par_page;

// Sélectionner une portion des emails à afficher
$emails_pagination = array_slice($emails, $index_debut, $emails_par_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails vérifiés</title>
    <!-- Inclusion de la feuille de style Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Favicons pour les icônes de l'application -->
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>

<section class="cards">
    <!-- Lien vers la page d'accueil -->
    <a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo"></a>
    
    <!-- Lien pour revenir à la page d'index -->
    <a href="../index.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>

    <!-- Titre principal de la page -->
    <h1 class="title">Liste des Emails vérifiés</h1>

    <!-- Lien pour télécharger les résultats (emails vérifiés) -->
    <a href="<?php echo verified_file ?>" class="btn-download" download="emails_verifies.txt">
        Télécharger les résultats de la table <i class="fa fa-download"></i>
    </a>

    <!-- Table des emails vérifiés -->
    <table>
        <thead>
            <tr>
                <th>Adresse Email</th>
            </tr>
        </thead>
        <tbody>
            <!-- Affichage des emails vérifiés dans le tableau -->
            <?php foreach ($emails_pagination as $email) : ?>
            <tr>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Navigation de pagination -->
    <div class="pagination">
        <!-- Lien vers la page précédente -->
        <?php if ($page_actuelle > 1) : ?>
            <a href="?page=1">&laquo; Première</a>
            <a href="?page=<?php echo $page_actuelle - 1; ?>">Précédente</a>
        <?php endif; ?>

        <!-- Affichage de la page actuelle et du total -->
        <span>Page <?php echo $page_actuelle; ?> sur <?php echo $total_pages; ?></span>

        <!-- Lien vers la page suivante -->
        <?php if ($page_actuelle < $total_pages) : ?>
            <a href="?page=<?php echo $page_actuelle + 1; ?>">Suivante</a>
            <a href="?page=<?php echo $total_pages; ?>">Dernière &raquo;</a>
        <?php endif; ?>
    </div>

</section>

</body>
</html>

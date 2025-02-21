<?php

// Inclusion des fichiers de configuration et des fonctions
include '../includes/config.php'; // Configuration générale
include '../includes/functions.php'; // Fonctions utiles pour le projet

// Récupération du domaine passé en paramètre dans l'URL
$domain = $_GET['domain'];

// Construction du chemin vers le fichier contenant les emails du domaine
$filename = domain_folder . "$domain.txt";

// Lecture du fichier contenant les emails du domaine spécifié
$emails_du_domaine = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lecture des emails valides à partir d'un fichier spécifique
$emails = lire_emails(valid_file);
$emails_valides = $emails['valides'];

// Pagination
$items_per_page = 7;
$total_items = count($emails_du_domaine);
$total_pages = ceil($total_items / $items_per_page);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_index = ($current_page - 1) * $items_per_page;

$emails_pagination = array_slice($emails_du_domaine, $start_index, $items_per_page);

// Pagination links
$max_links = 5;
$start_page = max(1, $current_page - floor($max_links / 2));
$end_page = min($total_pages, $start_page + $max_links - 1);

if ($end_page - $start_page + 1 < $max_links) {
    $start_page = max(1, $end_page - $max_links + 1);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emails pour <?php echo htmlspecialchars($domain); ?></title>
    <!-- Intégration de Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Intégration du fichier CSS pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Icônes et favicon pour le site -->
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>

<!-- Lien vers la page d'accueil -->
<a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo"></a>

<!-- Bouton pour revenir à la liste des domaines -->
<a href="liste_domaines.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>

<section class="cards">
    <!-- Titre principal de la page -->
    <h1 class="title">Emails pour le domaine: <?php echo htmlspecialchars($domain); ?></h1>

    <!-- Lien pour télécharger les résultats sous forme de fichier texte -->
    <a href="<?php echo $filename; ?>" download class="btn-download">
       Télécharger les résultats de la table<i class="fa fa-download"></i> 
    </a>

    <!-- Table affichant les emails et leur fréquence -->
    <table>
        <thead>
            <tr>
                <th>Adresse Email</th>
                <th>Fréquence</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emails_pagination as $email) : ?>
            <tr>
                <td><?php echo htmlspecialchars($email); ?></td>
                <td><?php echo $emails_valides[$email]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="pagination">
        <?php if($current_page > 1): ?>
            <a href="?domain=<?php echo htmlspecialchars($domain); ?>&page=<?php echo $current_page - 1; ?>">Précédent</a>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <a href="?domain=<?php echo htmlspecialchars($domain); ?>&page=1">1</a>
            <?php if($start_page > 2): ?>
                <span>...</span>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <a href="?domain=<?php echo htmlspecialchars($domain); ?>&page=<?php echo $i; ?>" <?php if($i == $current_page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if($end_page < $total_pages): ?>
            <?php if($end_page < $total_pages - 1): ?>
                <span>...</span>
            <?php endif; ?>
            <a href="?domain=<?php echo htmlspecialchars($domain); ?>&page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
        <?php endif; ?>

        <?php if($current_page < $total_pages): ?>
            <a href="?domain=<?php echo htmlspecialchars($domain); ?>&page=<?php echo $current_page + 1; ?>">Suivant</a>
        <?php endif; ?>
    </div>

</section>

</body>
</html>

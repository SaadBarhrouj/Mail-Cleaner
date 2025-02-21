<?php
// Inclusion des fichiers nécessaires pour les fonctions et la configuration
include '../includes/functions.php';
include '../includes/config.php';

// Séparer les emails par domaine et les stocker dans des fichiers
// Appel de la fonction 'separerEmailsParDomaine' en passant le nom de fichier valide
separerEmailsParDomaine(valid_file);

// Récupérer les fichiers des domaines à partir du répertoire spécifié
$domain_files = glob(domain_folder . '*.txt');

// Tableau pour stocker les emails par domaine
$domainEmails = [];

// Parcourir chaque fichier de domaine et récupérer les emails associés
foreach ($domain_files as $file) {
    // Récupérer le nom du domaine sans l'extension '.txt'
    $domain = basename($file, '.txt');
    
    // Lire le contenu du fichier et stocker les emails dans le tableau
    $domainEmails[$domain] = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Pagination
$items_per_page = 7; // Nombre d'éléments par page
$total_items = count($domainEmails); // Nombre total de domaines
$total_pages = ceil($total_items / $items_per_page); // Nombre total de pages
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle (par défaut, page 1)
$start_index = ($current_page - 1) * $items_per_page; // Index de départ pour la pagination

// Extraction des domaines pour la page actuelle
$domains_pagination = array_slice(array_keys($domainEmails), $start_index, $items_per_page);

// Calcul des pages à afficher dans la pagination
$max_links = 5; // Nombre maximum de liens de pagination
$start_page = max(1, $current_page - floor($max_links / 2)); // Page de départ pour la pagination
$end_page = min($total_pages, $start_page + $max_links - 1); // Page de fin pour la pagination

// Ajustement si le nombre de pages affichées est inférieur au maximum
if ($end_page - $start_page + 1 < $max_links) {
    $start_page = max(1, $end_page - $max_links + 1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Domaines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
    <section class="cards">
        <a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo"></a>
        <a href="../index.php" class="return-button"><i class="fa fa-arrow-right"></i></a>
        
        <h1 class="title">Liste des Domaines</h1>

        <div class="domains">
            <ul>
                <?php 
                // Afficher les domaines pour la page actuelle
                foreach ($domains_pagination as $domain) : ?>
                <li>
                    <a href="afficher_emails_par_domaine.php?domain=<?php echo urlencode($domain); ?>">
                        <?php echo htmlspecialchars($domain); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>">Précédent</a>
            <?php endif; ?>

            <?php if($start_page > 1): ?>
                <a href="?page=1">1</a>
                <?php if($start_page > 2): ?>
                    <span>...</span>
                <?php endif; ?>
            <?php endif; ?>

            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php if($i == $current_page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if($end_page < $total_pages): ?>
                <?php if($end_page < $total_pages - 1): ?>
                    <span>...</span>
                <?php endif; ?>
                <a href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
            <?php endif; ?>

            <?php if($current_page < $total_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>">Suivant</a>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>

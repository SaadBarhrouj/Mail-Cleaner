<?php
// Inclusion des fichiers de configuration et des fonctions
include '../includes/config.php'; 
include '../includes/functions.php';

// Récupération des emails valides et non valides
$emails = lire_emails(valid_file);
$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

// Traitement des emails non valides : ajout à un fichier si ce n'est pas déjà fait
foreach (array_keys($emails_non_valides) as $email) {
    if (!email_non_valide_exist($email, invalid_file)) {
        file_put_contents(invalid_file, $email . PHP_EOL, FILE_APPEND);
    }
}

// Traitement des emails valides : on les rend uniques et on les trie
$emails_uniques_valides = array_keys($emails_valides);
$emails_uniques_valides = array_unique($emails_uniques_valides);

// Trie des emails valides
sort($emails_uniques_valides);

// Sauvegarde des emails triés dans un fichier
file_put_contents(emailsT_file, implode(PHP_EOL, $emails_uniques_valides));

// Lecture du fichier contenant les emails triés
$emailsT = file(emailsT_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Pagination
// Définit le nombre d'éléments par page
$items_per_page = 10;

// Total des emails
$total_items = count($emailsT);

// Calcul du nombre total de pages nécessaires
$total_pages = ceil($total_items / $items_per_page);

// Récupération de la page actuelle via l'URL, par défaut page 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcul de l'index de départ pour cette page
$start_index = ($current_page - 1) * $items_per_page;

// Récupération des emails à afficher pour cette page
$emails_pagination = array_slice($emailsT, $start_index, $items_per_page);

// Calcul des pages à afficher dans la pagination
$max_links = 5; // Nombre maximum de liens à afficher dans la pagination
$start_page = max(1, $current_page - floor($max_links / 2)); // Page de départ
$end_page = min($total_pages, $start_page + $max_links - 1); // Page de fin

// Ajustement des pages de début et de fin si nécessaire
if ($end_page - $start_page + 1 < $max_links) {
    $start_page = max(1, $end_page - $max_links + 1);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails Triés</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>

<!-- Lien vers la page d'accueil -->
<a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo"></a>

<!-- Lien pour revenir à la page d'index -->
<a href="../index.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>

<section class="cards">
    <!-- Titre principal de la page -->
    <h1 class="title">Liste des Emails Triés</h1>

    <!-- Lien pour télécharger les résultats -->
    <a href="<?php echo emailsT_file?>" class="btn-download" download="emails_valides_tries.txt">
        Télécharger les résultats de la table <i class="fa fa-download"></i> 
    </a>

    <!-- Table des emails triés -->
    <table>
        <thead>
            <tr>
                <th>Adresse Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emails_pagination as $email) : ?>
            <tr>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <!-- Lien vers la page précédente si ce n'est pas la première page -->
        <?php if($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>">Précédent</a>
        <?php endif; ?>

        <!-- Liens vers les pages avec gestion des ellipses pour les pages au début et à la fin -->
        <?php if($start_page > 1): ?>
            <a href="?page=1">1</a>
            <?php if($start_page > 2): ?>
                <span>...</span>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Affichage des liens de pages -->
        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if($i == $current_page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <!-- Liens vers les pages suivantes si ce n'est pas la dernière page -->
        <?php if($end_page < $total_pages): ?>
            <?php if($end_page < $total_pages - 1): ?>
                <span>...</span>
            <?php endif; ?>
            <a href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
        <?php endif; ?>

        <!-- Lien vers la page suivante si ce n'est pas la dernière page -->
        <?php if($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>">Suivant</a>
        <?php endif; ?>
    </div>
</section>

</body>
</html>

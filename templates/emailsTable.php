<?php

// Inclusion des fichiers de configuration et des fonctions
include '../includes/config.php'; // Configuration générale
include '../includes/functions.php'; // Fonctions nécessaires pour le projet

// Lecture des emails valides et non valides à partir d'un fichier
$emails = lire_emails(valid_file);

// Séparation des emails valides et non valides
$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

// Traitement des emails non valides : ajout dans le fichier "invalid_file" si l'email n'existe pas déjà
foreach (array_keys($emails_non_valides) as $email) {
    if (!email_non_valide_exist($email, invalid_file)) {
        file_put_contents(invalid_file, $email . PHP_EOL, FILE_APPEND);
    }
}

// Extraction des emails uniques valides et tri par ordre alphabétique
$emails_uniques_valides = array_keys($emails_valides);
$emails_uniques_valides = array_unique($emails_uniques_valides);
sort($emails_uniques_valides);

// Enregistrement des emails uniques valides dans un fichier
file_put_contents(emailsT_file, implode(PHP_EOL, $emails_uniques_valides));

// Gestion de la pagination
$items_per_page = 7; // Nombre d'éléments par page
$total_items = count($emails_uniques_valides); // Nombre total d'emails
$total_pages = ceil($total_items / $items_per_page); // Nombre total de pages
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle (par défaut, page 1)
$start_index = ($current_page - 1) * $items_per_page; // Index de départ pour la pagination

// Extraction des emails pour la page actuelle
$emails_pagination = array_slice($emails_uniques_valides, $start_index, $items_per_page);

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
    <title>Liste des Emails Valides</title>
    <!-- Intégration de Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Fichier CSS pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Icônes et favicon pour le site -->
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
    <section class="cards">
        <!-- Lien vers la page d'accueil -->
        <a href="../home.php" class="logo"><img src="../images/logo.png" alt="Logo"></a>

        <!-- Bouton pour revenir à la page d'index -->
        <a href="../index.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
        
        <!-- Titre principal de la page -->
        <h1 class="title">Liste des Emails Valides</h1>

        <!-- Lien pour télécharger les résultats sous forme de fichier texte -->
        <a href="<?php echo valid_file?>" class="btn-download" download="emails_valides.txt">
            Télécharger les résultats de la table <i class="fa fa-download"></i>
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
            <!-- Lien vers la page précédente -->
            <?php if($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>">Précédent</a>
            <?php endif; ?>

            <!-- Lien vers la première page si nécessaire -->
            <?php if($start_page > 1): ?>
                <a href="?page=1">1</a>
                <?php if($start_page > 2): ?>
                    <span>...</span>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Liens pour les pages intermédiaires -->
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php if($i == $current_page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <!-- Lien vers la dernière page si nécessaire -->
            <?php if($end_page < $total_pages): ?>
                <?php if($end_page < $total_pages - 1): ?>
                    <span>...</span>
                <?php endif; ?>
                <a href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
            <?php endif; ?>

            <!-- Lien vers la page suivante -->
            <?php if($current_page < $total_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>">Suivant</a>
            <?php endif; ?>
        </div>

    </section>
</body>
</html>

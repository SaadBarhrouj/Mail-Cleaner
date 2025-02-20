<?php
include '../includes/config.php';
include '../includes/functions.php';

$emails = lire_emails(valid_file);

$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

foreach (array_keys($emails_non_valides) as $email) {
    if (!email_non_valide_exist($email, invalid_file)) {
        file_put_contents(invalid_file, $email . PHP_EOL, FILE_APPEND);
    }
}

$emails_uniques_valides = array_keys($emails_valides);
$emails_uniques_valides = array_unique($emails_uniques_valides);

sort($emails_uniques_valides);

file_put_contents(emailsT_file, implode(PHP_EOL, $emails_uniques_valides));

$items_per_page = 7;
$total_items = count($emails_uniques_valides);
$total_pages = ceil($total_items / $items_per_page);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_index = ($current_page - 1) * $items_per_page;

$emails_pagination = array_slice($emails_uniques_valides, $start_index, $items_per_page);

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
    <title>Liste des Emails Valides</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
    <section class="cards">
    <a href="../home.php" class="logo"><img src="../images/logo.png" alt=""></a>
    <a href="../index.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
        <h1 class="title">Liste des Emails Valides</h1>
        <a href="<?php echo valid_file?>" class="btn-download" download="emails_valides.txt">
        Télécharger les résultats de la table<i class="fa fa-download"></i> 
       </a>
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
                    <td><?php echo $email; ?></td>
                    <td><?php echo $emails_valides[$email]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
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

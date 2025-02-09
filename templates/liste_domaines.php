<?php

include '../includes/functions.php';
include '../includes/config.php';

separerEmailsParDomaine(valid_file);

$domain_files = glob(domain_folder . '*.txt');
$domainEmails = [];
foreach ($domain_files as $file) {
    $domain = basename($file, '.txt');
    $domainEmails[$domain] = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Domaines</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
    <a href="../index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Liste des Domaines</h1>
       <div class="domains">
       <ul>
            <?php foreach ($domainEmails as $domain => $emails) : ?>
            <li><a href="afficher_emails_par_domaine.php?domain=<?php echo urlencode($domain); ?>"><?php echo htmlspecialchars($domain); ?></a></li>
            <?php endforeach; ?>
        </ul>
       </div>
    </section>
</body>
</html>

<?php

include '../includes/config.php';
include '../includes/functions.php'; 

$domain = $_GET['domain'];
$filename = domain_folder . "$domain.txt";
$emails_du_domaine = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$emails = lire_emails(valid_file);
$emails_valides = $emails['valides'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emails pour <?php echo htmlspecialchars($domain); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
<a href="../home.php" class="logo"><img src="../images/logo.png" alt=""></a>
<a href="liste_domaines.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
    <section class="cards">
        <h1 class="title">Emails pour le domaine: <?php echo htmlspecialchars($domain); ?></h1>
        <a href="<?php echo $filename; ?>" download class="btn-download">
           Télécharger les résultats de la table<i class="fa fa-download"></i> </a>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                    <th>Fréquence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emails_du_domaine as $email) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td><?php echo $emails_valides[$email]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

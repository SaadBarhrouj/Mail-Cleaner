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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="liste_domaines.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Emails pour le domaine: <?php echo htmlspecialchars($domain); ?></h1>
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

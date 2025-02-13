<?php
include '../includes/config.php';
include '../includes/functions.php';

email_verify(valid_file,verified_file);

// Lire les emails depuis le fichier vérifié
$emails = lire_emails_simple(verified_file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails vérifiés</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
    <section class="cards">
        <a href="../home.php" class="logo"><img src="../images/logo.png" alt=""></a>
        <a href="../home.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
        <h1 class="title">Liste des Emails vérifiés</h1>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emails as $email) : ?>
                <tr>
                    <td><?php echo $email; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

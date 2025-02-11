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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails Valides</title>
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
        <h1 class="title">Liste des Emails Valides</h1>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                    <th>Fréquence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_keys($emails_valides)  as $email) : ?>
                <tr>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $emails_valides[$email]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

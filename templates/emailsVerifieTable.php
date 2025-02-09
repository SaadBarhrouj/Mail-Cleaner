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

// Si on souhaite supprimer du fichier aussi les adresses non valides
//file_put_contents(valid_file, implode(PHP_EOL, $emails_uniques_valides));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails Valides</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="../index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Liste des Emails Valides</h1>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                    <th>Fréquence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emails_uniques_valides as $email) : ?>
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

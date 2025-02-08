<?php
include '../includes/functions.php';

$emails = lire_emails('../data/Emails.txt');

$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

$emails_uniques_valides = array_keys($emails_valides);
sort($emails_uniques_valides);

file_put_contents('../data/EmailsT.txt', implode("\n", $emails_uniques_valides));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails Vérifiés</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="../index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Liste des Emails Vérifiés</h1>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                    <th>Fréquence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emails_valides as $email => $frequency) : ?>
                <tr>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $frequency; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

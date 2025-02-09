<?php
include '../includes/config.php'; 
include '../includes/functions.php';
// Test pour afficher la constante et vérifier qu'elle est bien définie

// Lire les emails depuis le fichier
$emails = lire_emails(valid_file);

$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

// Supprimer les adresses non valides de la liste et les enregistrer dans adressesNonValides.txt sans écraser les données existantes
foreach (array_keys($emails_non_valides) as $email) {
    if (!email_non_valide_exist($email, invalid_file)) {
        file_put_contents(invalid_file, $email . PHP_EOL, FILE_APPEND);
    }
}

// Supprimer les doublons des emails valides
$emails_uniques_valides = array_keys($emails_valides);
$emails_uniques_valides = array_unique($emails_uniques_valides);

// Trier les emails valides
sort($emails_uniques_valides);

// Enregistrer les emails valides triés dans EmailsT.txt
file_put_contents(emailsT_file, implode(PHP_EOL, $emails_uniques_valides));

// Si on souhaite supprimer du fichier aussi les adresses non valides
//file_put_contents(valid_file, implode(PHP_EOL, $emails_uniques_valides));

// Lire les emails triés depuis EmailsT.txt
$emailsT = file(emailsT_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails Triés</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="../index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Liste des Emails Triés</h1>
        <table>
            <thead>
                <tr>
                    <th>Adresse Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emailsT as $email) : ?>
                <tr>
                    <td><?php echo $email; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>

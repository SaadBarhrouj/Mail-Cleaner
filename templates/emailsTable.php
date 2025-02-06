<?php

//methode 1:
function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}
//methode 2:

function validateEmail_2($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    } else {
        return false;
    }
}


function lire_emails($fichier) {
    $emails_valides = [];
    $emails_non_valides = [];

    if (file_exists($fichier)) {
        $lines = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line_emails = preg_split('/\s+|,|;/', $line);
            foreach ($line_emails as $email) {
                if (validateEmail($email)) {
                    $emails_valides[] = $email;
                } else {
                    $emails_non_valides[] = $email;
                }
            }
        }
    }

    return [
        'valides' => array_count_values($emails_valides),
        'non_valides' => array_unique($emails_non_valides)
    ];
}

$emails = lire_emails('../data/Emails.txt');

$emails_valides = $emails['valides'];
$emails_non_valides = $emails['non_valides'];

$emails_uniques_valides = array_keys($emails_valides);
sort($emails_uniques_valides);

$emails_uniques_non_valides = array_values($emails_non_valides);
sort($emails_uniques_non_valides);

file_put_contents('../data/EmailsT.txt', implode("\n", $emails_uniques_valides));
file_put_contents('../data/AdressesEmailsNonValides.txt', implode("\n", $emails_uniques_non_valides));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Emails</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Liste des Emails Valides</h1>
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
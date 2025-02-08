<?php
// Methode 1
function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}

// Methode 2
function validateEmail_2($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Lire les emails depuis un fichier et les valider
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

// Ajouter un email au fichier correspondant
function ajouter_email($email) {
    if (validateEmail_2($email)) {
        file_put_contents("../data/Emails.txt", "\n" . $email . "\n", FILE_APPEND);
        echo "<p class='success'>Adresse email ajoutée dans Emails.txt !</p>";
    } else {
        file_put_contents("../data/AdressesEmailsNonValides.txt", "\n" . $email . "\n", FILE_APPEND);
        echo "<p class='error'>Adresse email invalide. Ajoutée dans AdressesEmailsNonValides.txt.</p>";
    }
}
?>

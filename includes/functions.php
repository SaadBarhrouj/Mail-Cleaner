<?php

// Méthode  1 de validation d'email 

function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}

// Méthode  2 de validation d'email 

function validateEmail_2($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
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

// Fonction pour verifier si un email existe dans la liste des emails valides
function email_exist($newEmail, $file) {
    $emails = lire_emails($file);
    $emails_valides = array_keys($emails['valides']);
    foreach ($emails_valides as $email) {
        if ($email == $newEmail) {
            return true;
        }
    }
    return false;
}

// Fonction pour ajouter un email au fichier correspondant
function ajouter_email($email) {
    if (validateEmail_2($email)) {
        if (email_exist($email, "../data/Emails.txt")) {
            echo "<p class='error'>Adresse email déjà existante.</p>";
        } else {
            file_put_contents("../data/Emails.txt", "\n" . $email, FILE_APPEND);
            echo "<p class='success'>Adresse email ajoutée dans Emails.txt !</p>";
        }
    } else {
        file_put_contents("../data/AdressesEmailsNonValides.txt", "\n" . $email, FILE_APPEND);
        echo "<p class='error'>Adresse email invalide. Ajoutée dans AdressesEmailsNonValides.txt.</p>";
    }
}


// Fonction our séparer les emails valides par domaine 
function separerEmailsParDomaine($fichier) {
    $emails = lire_emails($fichier);
    $emails_valides = array_keys($emails['valides']);
    $domainEmails = [];

    foreach ($emails_valides as $email) {
        $domain = substr(strrchr($email, "@"), 1);
        $domainEmails[$domain][] = $email;
    }

    foreach ($domainEmails as $domain => $emails) {
        $filename = "../data/domains/$domain.txt";
        file_put_contents($filename, implode(PHP_EOL, $emails));
    }
}

?>

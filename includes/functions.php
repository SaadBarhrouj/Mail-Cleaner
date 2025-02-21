<?php

//========================= Méthode 1 : Validation d'email ==============================

/**
 * Valide un email à l'aide d'une expression régulière.
 *
 * @param string $email L'email à valider.
 * @return bool Retourne true si l'email est valide, sinon false.
 */
function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}

//========================= Méthode 2 : Validation d'email ================================

/**
 * Valide un email en utilisant la fonction filter_var.
 *
 * @param string $email L'email à valider.
 * @return bool Retourne true si l'email est valide, sinon false.
 */
function validateEmail_2($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

//========================= Lire les emails depuis un fichier et les valider =================

/**
 * Lit les emails depuis un fichier et les valide.
 * Sépare les emails valides et non valides.
 *
 * @param string $fichier Le chemin du fichier contenant les emails.
 * @return array Retourne un tableau contenant le nombre d'emails valides et non valides.
 */
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
        $emails_valides_string = implode(PHP_EOL, $emails_valides);
        file_put_contents($fichier, $emails_valides_string);
    }

    return [
        'valides' => array_count_values($emails_valides),
        'non_valides' => array_count_values($emails_non_valides)
    ];
}


//========================= Fonction pour vérifier si un email existe dans la liste des emails valides =================

/**
 * Vérifie si un email existe déjà dans la liste des emails valides.
 *
 * @param string $newEmail L'email à vérifier.
 * @param string $file Le chemin du fichier contenant les emails validés.
 * @return bool Retourne true si l'email existe, sinon false.
 */
function email_valide_exist($newEmail, $file) {
    $emails = lire_emails($file);
    $emails_valides = array_keys($emails['valides']);
    return in_array($newEmail, $emails_valides);
}

//========================= Fonction pour vérifier si un email non valide existe déjà dans la liste des emails non valides =================

/**
 * Vérifie si un email non valide existe déjà dans la liste des emails non valides.
 *
 * @param string $email L'email à vérifier.
 * @param string $file Le chemin du fichier contenant les emails non validés.
 * @return bool Retourne true si l'email existe, sinon false.
 */
function email_non_valide_exist($email, $file) {
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return in_array($email, $lines);
    }
    return false;
}

//========================= Fonction pour ajouter un email au fichier correspondant =================

/**
 * Ajoute un email au fichier des emails validés ou non validés.
 *
 * @param string $email L'email à ajouter.
 * @param string $valid_file Le fichier où ajouter l'email valide.
 * @param string $invalid_file Le fichier où ajouter l'email invalide.
 */
function ajouter_email($email, $valid_file, $invalid_file) {
    if (validateEmail_2($email)) {
        if (email_valide_exist($email, $valid_file)) {
            echo "<p class='error'>Adresse email déjà existante.</p>";
        } else {
            file_put_contents($valid_file, PHP_EOL . $email . PHP_EOL, FILE_APPEND);
            echo "<p class='success'>Adresse email ajoutée dans Emails.txt !</p>";
        }
    } else {
        if (!email_non_valide_exist($email, $invalid_file)) {
            file_put_contents($invalid_file, "\n" . $email, FILE_APPEND);
            echo "<p class='error'>Adresse email invalide. Ajoutée dans AdressesEmailsNonValides.txt.</p>";
        }
    }
}


//=========== Fonction pour vérifier les emails et les ajouter dans un fichier ============

/**
 * Vérifie la validité des emails et les ajoute dans un fichier de vérification.
 *
 * @param string $file Le fichier contenant les emails à vérifier.
 * @param string $file_verified_emails Le fichier où ajouter les emails validés.
 */
function email_verify($file,$file_verified_emails){
    $emails_verifies = [];
    $emails = lire_emails($file);
    $emails_valides = array_keys($emails['valides']);

    foreach($emails_valides as $email) {
        // Initialisation de cURL.
        $ch = curl_init();

        // Récupérer la clé API depuis la variable d'environnement.
        $api_key = getenv('API_KEY');

        // Définir l'URL de la requête cURL.
        curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email");

        // Définir CURLOPT_RETURNTRANSFER pour obtenir le contenu de la réponse.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Suivre les redirections si nécessaire.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Exécuter la requête cURL.
        $response = curl_exec($ch);

        // Fermer la connexion cURL.
        curl_close($ch);

        $data = json_decode($response, true);

        // Vérifier la délivrabilité.
        if (isset($data) && isset($data['deliverability']) && $data['deliverability'] === "DELIVERABLE") {
            if (!email_non_valide_exist($email, $file_verified_emails)) {
                file_put_contents($file_verified_emails, "\n" . $email, FILE_APPEND);
            }
        }
    }
}

//=================== Fonction pour lire les emails ================

/**
 * Lit les emails depuis un fichier et les retourne dans un tableau.
 *
 * @param string $fichier Le chemin du fichier contenant les emails.
 * @return array Retourne un tableau d'emails.
 */
function lire_emails_simple($fichier) {
    $emails = [];

    if (file_exists($fichier)) {
        $lines = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line_emails = preg_split('/\s+|,|;/', $line);
            foreach ($line_emails as $email) {
                $emails[] = $email;
            }
        }
    }

    return $emails;
}


// =============================== Fonction pour supprimer un dossier ==============================

/**
 * Supprime un dossier et son contenu.
 *
 * @param string $folder Le chemin du dossier à supprimer.
 */
function deleteFolder($folder) {
    if (!is_dir($folder)) {
        return;
    }
    
    $files = array_diff(scandir($folder), ['.', '..']);
    foreach ($files as $file) {
        $filePath = $folder . DIRECTORY_SEPARATOR . $file;
        is_dir($filePath) ? deleteFolder($filePath) : unlink($filePath);
    }
    rmdir($folder);
}

//========================= Fonction pour séparer les emails valides par domaine =================

/**
 * Sépare les emails valides par domaine et les sauvegarde dans des fichiers séparés.
 *
 * @param string $fichier Le chemin du fichier contenant les emails à traiter.
 * @return string Retourne un message d'erreur si la création du dossier échoue, sinon rien.
 */
function separerEmailsParDomaine($fichier) {
    $emails = lire_emails($fichier);
    $emails_valides = array_keys($emails['valides']);
    $domainEmails = [];

    $domainsDir = '../data/domains/';
    if (is_dir($domainsDir)) {
        deleteFolder($domainsDir);
    }

    if (!mkdir($domainsDir, 0777, true) && !is_dir($domainsDir)) {
        return "Erreur lors de la création du dossier domains.";
    }

    foreach ($emails_valides as $email) {
        $domain = substr(strrchr($email, "@"), 1);
        $domainEmails[$domain][] = $email;
    }

    foreach ($domainEmails as $domain => $emails) {
        $filename = $domainsDir . $domain . '.txt';
        file_put_contents($filename, implode(PHP_EOL, $emails));
    }
}

//=========================================================

/**
 * Gère l'upload d'un fichier et le place dans le répertoire approprié.
 *
 * @param array $file Le fichier à télécharger.
 * @return string Retourne un message indiquant si l'upload a réussi ou échoué.
 */
function handleFileUpload($file) {
    $uploadDir = 'data/';
    $uploadFile = $uploadDir . 'Emails.txt';

    if (is_dir($uploadDir)) {
        deleteFolder($uploadDir);
    }

    if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
        return "<p class='error'>Erreur lors de la création du dossier data.</p>";
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "<p class='error'>Erreur lors de l'upload du fichier.</p>";
    }

    $filename = basename($file['name']);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (strtolower($extension) !== 'txt') {
        return "<p class='error'>Extension non autorisée. Seuls les fichiers .txt sont acceptés.</p>";
    }

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        return "<p class='success'>Le fichier a été téléchargé avec succès et sauvegardé sous le nom Emails.txt.</p>";
    } else {
        return "<p class='error'>Erreur lors du déplacement du fichier.</p>";
    }
}

?>


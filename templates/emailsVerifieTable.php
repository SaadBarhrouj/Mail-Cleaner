<?php 
include '../includes/functions.php';
include '../includes/config.php';  

function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
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
        $emails_valides_string = implode(PHP_EOL, $emails_valides);
        file_put_contents($fichier, $emails_valides_string);
    }

    return [
        'valides' => array_count_values($emails_valides),
        'non_valides' => array_count_values($emails_non_valides)
    ];
}

function email_verify($file,$file_verified_emails){
    $emails_verifies = [];
    $emails = lire_emails($file);
    $emails_valides = array_keys($emails['valides']);

    foreach($emails_valides as $email){
        // Initialize cURL.
        $ch = curl_init();
        $api_key="d04618536639472e9c8dce61713a7780";

        // Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email");

        // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


        // Execute the request.
        $response= curl_exec($ch);


        // Close the cURL handle.
        curl_close($ch);

        $data =json_decode($response,true);

        // Print the data out onto the page.
                if($data['deliverability']==="DELIVERABLE"){
                    file_put_contents($file_verified_emails, "\n" . $email, FILE_APPEND);
                }
                
        }
}
email_verify(valid_file,verified_file);

?>
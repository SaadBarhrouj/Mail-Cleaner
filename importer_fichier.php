<?php
include 'includes/functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['userfile'])) {
    $result = handleFileUpload($_FILES['userfile']);
    
    // Si la fonction renvoie un message d'erreur (avec la classe 'error')
    if (strpos($result, "<p class='error'>") !== false) {
        $message = $result;  // Affiche l'erreur
    } else {
        // Si pas d'erreur, redirige vers index.php
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Gestion des Emails</title>
    <link rel="apple-touch-icon" sizes="180x180" href="includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="includes/site.webmanifest">
</head>
<body>
    <a href="home.php" class="logo"><img src="images/logo.png" alt=""></a>
    <a href="home.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
    <section class="cards" id="cardsSection">
        <h2 class="title">Gestion des Emails</h2>
        
        <?php if (!empty($message)): ?>
            <?= $message ?>  
        <?php endif; ?>
        
        <div class="form">
            <form enctype="multipart/form-data" action="" method="post" id="fileForm">
                <input type="file" name="userfile" required id="fileInput">
                <button type="submit"><i class="fa fa-upload"></i> Envoyer</button>
            </form>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>
</html>

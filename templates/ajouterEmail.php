<?php
include '../includes/config.php';  
include '../includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../includes/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../includes/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../includes/favicons/favicon-16x16.png">
    <link rel="manifest" href="../includes/site.webmanifest">
</head>
<body>
<a href="../home.php" class="logo"><img src="../images/logo.png" alt=""></a>
<a href="../index.php" class="return-button"> <i class="fa fa-arrow-right"></i></a>
    <section class="cards">
        <h1 class="title">Ajouter Email</h1>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            ajouter_email($email, valid_file, invalid_file); 
        }
        ?>
        <div class="form">
            <form action="" method="post">
                <input type="email" id="email" name="email"  placeholder="Entrez un email" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </section>
</body>
</html>

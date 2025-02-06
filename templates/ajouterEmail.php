<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="cards">
        <a href="index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Ajouter Email</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                file_put_contents("../data/Emails.txt", "\n" . $email . "\n", FILE_APPEND);
                echo "<p class='success'>Adresse email invalide. ajoutée  dans Emails.txt !</p>";
              
            } else {
                file_put_contents("../data/AdressesEmailsNonValides.txt", "\n" . $email . "\n", FILE_APPEND);
                echo "<p class='error'>Adresse email invalide. Ajoutée dans AdressesEmailsNonValides.txt.</p>";

            }
        }
        ?>
        <div class="form">
            <form action="" method="post">
                <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </section>
</body>
</html>

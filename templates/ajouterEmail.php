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
        <a href="../index.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>
        <h1 class="title">Ajouter Email</h1>
        <?php
        include '../includes/functions.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            ajouter_email($email);
        }
        ?>
        <div class="form">
            <form action="" method="post">
                <input type="email" id="email" name="email" placeholder="Entrez un email" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </section>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestion des Emails</title>
</head>

<body>
<a href="home.php" class="return-button"><i class="fa fa-arrow-left"></i> Retour</a>

    <section class="cards">
        <h2 class="title">Gestion des Emails</h2>
        <div class="content">

            <div class="card">
                <div class="icon">
                    <a href="templates/ajouterEmail.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="info">
                    <h3>Ajouter un Email</h3>
                    <p>Ajouter une nouvelle adresse email à la liste des emails enregistrés.</p>
                </div>
            </div>

            <div class="card">
                <div class="icon">
                    <a href="templates/emailsTable.php"><i class="fa fa-table"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Valides</h3>
                    <p>Voir toutes les adresses emails validées et leur fréquence d'utilisation.</p>
                </div>
            </div>

            <div class="card">
                <div class="icon">
                    <a href="templates/emailsTableTriees.php"><i class="fa fa-sort"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Valides Triés</h3>
                    <p>Voir toutes les adresses emails triées et valides.</p>
                </div>
            </div>

            <div class="card">
                <div class="icon">
                    <a href="templates/liste_domaines.php"><i class="fa fa-list-alt"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails par Domaine</h3>
                    <p>Voir toutes les adresses emails validées par domaine, et leur fréquence d'utilisation.</p>
                </div>
            </div>

            <div class="card">
                <div class="icon">
                    <a href="templates/emailsVerifieTable.php"><i class="fa fa-check-circle"></i></a>
                </div>
                <div class="info">
                    <h3>Afficher les Emails Vérifiés</h3>
                    <p>Voir toutes les adresses emails vérifiées et leur fréquence d'utilisation.</p>
                </div>
            </div>

        </div>
    </section>
</body>

</html>

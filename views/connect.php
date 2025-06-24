<?php
session_start();
require_once '../model/Controller.inc.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection réussie</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/accueil.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="./liste.php">Liste</a></li>
                <li> <a href="./modification.php"><img src="../asset/utilisateur.png" alt="PP"></a></li>
                <li><a href="./logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h1>Bienvenue sur l'intranet</h1>
            <p>La plate-forme qui vous permet de retrouver tous vos collaborateur</p>
            <figure>
                <figcaption>
                    <img src="<?= htmlspecialchars($user['photo']) ?>" alt="Photo de profil">
                    <div class="info_utilisateur">
                        <p class="nom_utilisateur">
                            <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                            <?php
                            if (!empty($user['date_naissance'])) {
                                $age = (new DateTime($user['date_naissance']))->diff(new DateTime('now'))->y;
                                echo " ($age ans)";
                            }
                            ?>
                        </p>
                        <p><?= htmlspecialchars($user['adresse'] . ', ' . $user['ville']) ?></p>
                        <div>
                            <img src="../asset/email.png" alt="">
                            <p><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                        <div>
                            <img src="../asset/telephone.png" alt="">
                            <p><?= htmlspecialchars($user['telephone']) ?></p>
                        </div>
                        <div>
                            <img src="../asset/gateau-danniversaire.png" alt="">
                            <p>Anniversaire : 
                                <?php
                                if (!empty($user['date_naissance'])) {
                                    echo (new DateTime($user['date_naissance']))->format('j F');
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </figcaption>
            </figure>
            <button><a href="./liste_utilisateur.html">DIRE BONJOUR A QUELQU'UN D'AUTRE</a></button>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>
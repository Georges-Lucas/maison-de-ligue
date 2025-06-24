<?php
require_once '../model/Controller.inc.php';
session_start();

$stmt = $pdo->query("SELECT * FROM collaborateurs");
$collaborateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des collaborateurs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/liste.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">Liste</a></li>
                <li> <a href="./modification.php"><img src="../asset/utilisateur.png" alt="PP"></a></li>
                <li><a href="./logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Liste des collaborateurs</h1>
        <div class="recherche">
            <form method="get" action="">
                <label for="nom">Rechercher par :
                    <input id="nom" name="nom" type="search" placeholder="Nom">
                </label>
                <label for="categorie">Catégorie :
                    <input type="text" id="categorie" name="categorie">
                </label>
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="liste">
            <?php foreach ($collaborateurs as $collaborateur): ?>
                <figure>
                    <figcaption>
                        <img src="<?= htmlspecialchars($collaborateur['photo']) ?>" alt="">
                        <div class="info_utilisateur">
                            <p>
                                <?= htmlspecialchars($collaborateur['prenom'] . ' ' . $collaborateur['nom']) ?>
                                <?php
                                if (!empty($collaborateur['date_naissance'])) {
                                    $age = (new DateTime($collaborateur['date_naissance']))->diff(new DateTime('now'))->y;
                                    echo " ($age ans)";
                                }
                                ?>
                            </p>
                            <p><?= htmlspecialchars($collaborateur['ville']) ?>, <?= htmlspecialchars($collaborateur['adresse']) ?></p>
                            <div>
                                <img src="../asset/email.png" alt="">
                                <p><?= htmlspecialchars($collaborateur['email']) ?></p>
                            </div>
                            <div>
                                <img src="../asset/telephone.png" alt="">
                                <p><?= htmlspecialchars($collaborateur['telephone']) ?></p>
                            </div>
                            <div>
                                <img src="../asset/gateau-danniversaire.png" alt="">
                                <p>Anniversaire :
                                    <?php
                                    if (!empty($collaborateur['date_naissance'])) {
                                        echo (new DateTime($collaborateur['date_naissance']))->format('j F');
                                    }
                                    ?>
                                </p>
                            </div>
                            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin']): ?>
                                <a href="editer.php?id=<?= $collaborateur['id'] ?>" class="btn-modifier">Modifier</a>
                                <form action="supprimer.php" method="post" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce collaborateur ?');">
                                    <input type="hidden" name="id" value="<?= $collaborateur['id'] ?>">
                                    <button type="submit" class="btn-supprimer">Supprimer</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
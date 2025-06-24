<?php
session_start();
require_once '../model/Controller.inc.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: ../index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM collaborateurs WHERE email = ?");
$stmt->execute([$user['email']]);
$collaborateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$collaborateur) {
    echo "Utilisateur non trouvé.";
    exit;
}

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'] !== '' ? $_POST['nom'] : $collaborateur['nom'];
    $prenom = $_POST['prenom'] !== '' ? $_POST['prenom'] : $collaborateur['prenom'];
    $email = $_POST['email'] !== '' ? $_POST['email'] : $collaborateur['email'];
    $mdp = $_POST['mdp'] ?? '';
    $telephone = $_POST['telephone'] !== '' ? $_POST['telephone'] : $collaborateur['telephone'];
    $naissance = $_POST['naissance'] !== '' ? $_POST['naissance'] : $collaborateur['date_naissance'];
    $ville = $_POST['ville'] !== '' ? $_POST['ville'] : $collaborateur['ville'];
    $adresse = $_POST['adresse'] !== '' ? $_POST['adresse'] : $collaborateur['adresse'];
    $photo = $_POST['photo'] !== '' ? $_POST['photo'] : $collaborateur['photo'];

    $sql = "UPDATE collaborateurs SET nom=?, prenom=?, email=?, telephone=?, date_naissance=?, ville=?, adresse=?, photo=?" .
           (!empty($mdp) ? ", password=?" : "") .
           " WHERE id=?";
    $params = [$nom, $prenom, $email, $telephone, $naissance, $ville, $adresse, $photo];
    if (!empty($mdp)) {
        $params[] = password_hash($mdp, PASSWORD_DEFAULT);
    }
    $params[] = $collaborateur['id'];

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        $success = "Profil modifié avec succès.";
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['photo'] = $photo;
        $_SESSION['user']['ville'] = $ville;
        $_SESSION['user']['adresse'] = $collaborateur['adresse'];
        $_SESSION['user']['date_naissance'] = $naissance;
        $_SESSION['user']['telephone'] = $telephone;
    } else {
        $error = "Erreur lors de la modification.";
    }
    $stmt = $pdo->prepare("SELECT * FROM collaborateurs WHERE id = ?");
    $stmt->execute([$collaborateur['id']]);
    $collaborateur = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/modification.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="./liste.php">Liste</a></li>
                <li> <a href=""><img src="../asset/utilisateur.png" alt="PP"></a></li>
                <li><a href="./logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <figure>
            <figcaption>
                <h1>Modifier mon profil</h1>
                <form action="" method="post">
                    <?php if ($success): ?><div style="color:green"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                    <label for="nom">Nom :
                        <input id="nom" name="nom" type="text" value="<?= htmlspecialchars($collaborateur['nom'] ?? '') ?>">
                    </label>
                    <label for="prenom">Prénom :
                        <input id="prenom" name="prenom" type="text" value="<?= htmlspecialchars($collaborateur['prenom'] ?? '') ?>">
                    </label>
                    <label for="email">Email :
                        <input id="email" name="email" type="text" value="<?= htmlspecialchars($collaborateur['email'] ?? '') ?>">
                    </label>
                    <label for="mdp">Mot de passe :
                        <input id="mdp" name="mdp" type="password" placeholder="Vide pour ne pas changer">
                    </label>
                    <label for="telephone">Téléphone :
                        <input id="telephone" name="telephone" type="text" value="<?= htmlspecialchars($collaborateur['telephone'] ?? '') ?>">
                    </label>
                    <label for="naissance">Date de naissance :
                        <input id="naissance" name="naissance" type="text" value="<?= htmlspecialchars($collaborateur['date_naissance'] ?? '') ?>">
                    </label>
                    <label for="ville">Ville :
                        <input id="ville" name="ville" type="text" value="<?= htmlspecialchars($collaborateur['ville'] ?? '') ?>">
                    </label>
                    <label for="adresse">Adresse :
                        <input id="adresse" name="adresse" type="text" value="<?= htmlspecialchars($collaborateur['adresse'] ?? '') ?>">
                    </label>
                    <label for="photo">URL de la photo :
                        <input id="photo" name="photo" type="text" value="<?= htmlspecialchars($collaborateur['photo'] ?? '') ?>">
                    </label>
                    <button type="submit">Modifier le profil</button>
                </form>
            </figcaption>
        </figure>
    </main>
    <footer>
    </footer>
</body>
</html>
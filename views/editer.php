<?php
session_start();
require_once '../model/Controller.inc.php';

$user = $_SESSION['user'] ?? null;
if (!$user || empty($user['is_admin'])) {
    header('Location: ../index.php');
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "Collaborateur non spécifié.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM collaborateurs WHERE id = ?");
$stmt->execute([$id]);
$collaborateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$collaborateur) {
    echo "Collaborateur non trouvé.";
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
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $sql = "UPDATE collaborateurs SET nom=?, prenom=?, email=?, telephone=?, date_naissance=?, ville=?, adresse=?, photo=?, is_admin=?" .
           (!empty($mdp) ? ", password=?" : "") .
           " WHERE id=?";
    $params = [$nom, $prenom, $email, $telephone, $naissance, $ville, $adresse, $photo, $is_admin];
    if (!empty($mdp)) {
        $params[] = password_hash($mdp, PASSWORD_DEFAULT);
    }
    $params[] = $collaborateur['id'];

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        $success = "Profil modifié avec succès.";
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
    <title>Éditer un collaborateur</title>
    <link rel="stylesheet" href="../css/modification.css">
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
        <figure>
            <figcaption>
                <h1>Modifier le profil de <?= htmlspecialchars($collaborateur['prenom'] . ' ' . $collaborateur['nom']) ?></h1>
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
                    <label for="is_admin">Administrateur :
                        <input id="is_admin" name="is_admin" type="checkbox" <?= $collaborateur['is_admin'] ? 'checked' : '' ?>>
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
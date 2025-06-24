<?php
session_start();
require_once '../model/Controller.inc.php';

// Vérifie que seul un admin peut accéder à l'inscription
$user = $_SESSION['user'] ?? null;
if (!$user || empty($user['is_admin'])) {
    header('Location: ../index.php');
    exit;
}

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mdp = $_POST['mdp'] ?? '';
    $telephone = trim($_POST['telephone'] ?? '');
    $naissance = trim($_POST['naissance'] ?? '');
    $ville = trim($_POST['ville'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $photo = trim($_POST['photo'] ?? '');
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Vérifie que tous les champs obligatoires sont remplis
    if ($nom && $prenom && $email && $mdp) {
        // Vérifie que l'email n'existe pas déjà
        $stmt = $pdo->prepare("SELECT id FROM collaborateurs WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé.";
        } else {
            $sql = "INSERT INTO collaborateurs (nom, prenom, email, password, telephone, date_naissance, ville, adresse, photo, is_admin)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = [
                $nom, $prenom, $email,
                password_hash($mdp, PASSWORD_DEFAULT),
                $telephone, $naissance, $ville, $adresse, $photo, $is_admin
            ];
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($params)) {
                $success = "Utilisateur inscrit avec succès.";
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription utilisateur</title>
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
                <h1>Inscrire un nouvel utilisateur</h1>
                <form action="" method="post">
                    <?php if ($success): ?><div style="color:green"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                    <?php if ($error): ?><div style="color:red"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                    <label for="nom">Nom :
                        <input id="nom" name="nom" type="text" required>
                    </label>
                    <label for="prenom">Prénom :
                        <input id="prenom" name="prenom" type="text" required>
                    </label>
                    <label for="email">Email :
                        <input id="email" name="email" type="email" required>
                    </label>
                    <label for="mdp">Mot de passe :
                        <input id="mdp" name="mdp" type="password" required>
                    </label>
                    <label for="telephone">Téléphone :
                        <input id="telephone" name="telephone" type="text">
                    </label>
                    <label for="naissance">Date de naissance :
                        <input id="naissance" name="naissance" type="text">
                    </label>
                    <label for="ville">Ville :
                        <input id="ville" name="ville" type="text">
                    </label>
                    <label for="adresse">Adresse :
                        <input id="adresse" name="adresse" type="text">
                    </label>
                    <label for="photo">URL de la photo :
                        <input id="photo" name="photo" type="text">
                    </label>
                    <label for="is_admin">
                        <input id="is_admin" name="is_admin" type="checkbox" value="1">
                        Administrateur
                    </label>
                    <button type="submit">Inscrire</button>
                </form>
            </figcaption>
        </figure>
    </main>
    <footer>
    </footer>
</body>
</html>
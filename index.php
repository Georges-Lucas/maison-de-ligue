<?php
require_once __DIR__ . '/model/Controller.inc.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM collaborateurs WHERE email = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mdp, $user['password'])) {
        $_SESSION['user'] = [
            'prenom' => $user['prenom'],
            'nom' => $user['nom'],
            'date_naissance' => $user['date_naissance'],
            'ville' => $user['ville'],
            'adresse' => $user['adresse'],
            'email' => $user['email'],
            'telephone' => $user['telephone'],
            'photo' => $user['photo'],
            'rôle' => $user['rôle'],
            'is_admin' => $user['is_admin']
        ];
        header('Location: views/connect.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Aguafina+Script&family=Caudex:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h1>Connexion</h1>
            <p>Pour vous connectez à l'intranet, veillez renseigner votre identifiant et mot de passe </p>
            <?php if ($error): ?>
                <div style="color:red"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <label for="mail">Email :</label>
                <input type="email" name="mail" id="mail" required>
                <label for="mdp">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" required>
                <button type="submit">Connexion</button>
            </form>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>
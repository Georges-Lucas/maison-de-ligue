<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{Vite::asset('resources/css/modification.css')}}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="./liste_utilisateur.html">Liste</a></li>
                <li> <a href="./modification.html"><img src="" alt="PP"></a></li>
                <li><a href="../index.html">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <figure>
            <figcaption>
                <h1>Modifier mon profil</h1>
                <form action="" method="post">
                    @csrf
                    <label for="civilite">Civilité :
                        <input id="civilite" type="text" placeholder="{{ $collaborateur->civilité ?? '' }}">
                    </label>
                    <label for="nom">Nom :
                        <input id="nom" type="text" placeholder="{{ $collaborateur->nom }}">
                    </label>
                    <label for="prenom">Prénom :
                        <input id="prenom" type="text" placeholder="{{ $collaborateur->prenom }}">
                    </label>
                    <label for="email">Email :
                        <input id="email" type="text" placeholder="{{ $collaborateur->email }}">
                    </label>
                    <label for="mdp">Mot de passe :
                        <input id="mdp" type="text" placeholder="Nouveau mot de passe">
                    </label>
                    <label for="mdp_c">Confirmation :
                        <input id="mdp_c" type="text" placeholder="Confirmer le mot de passe">
                    </label>
                    <label for="telephone">Téléphone :
                        <input id="telephone" type="text" placeholder="{{ $collaborateur->telephone }}">
                    </label>
                    <label for="naissance">Date de naissance :
                        <input id="naissance" type="text" placeholder="{{ $collaborateur->date_naissance }}">
                    </label>
                    <label for="adresse">Adresse :
                        <input id="adresse" type="text" placeholder="{{ $collaborateur->adresse }}">
                    </label>
                    <label for="ville">Ville :
                        <input id="ville" type="text" placeholder="{{ $collaborateur->ville }}">
                    </label>
                    <label for="photo">URL de la photo :
                        <input id="photo" type="text" placeholder="{{ $collaborateur->photo }}">
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
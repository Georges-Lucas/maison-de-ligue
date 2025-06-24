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
                <li><a href="{{ route('liste_utilisateur')}}">Liste</a></li>
                @if(isset($collaborateur) && $collaborateur->is_admin)
                    <li><a href="{{ route('store_utilisateur') }}">Inscription</a></li>
                @endif
                <li> <a href="{{ route('edit') }}"><img src="{{ asset('asset/utilisateur.png') }}" alt=""></a></li>
                <li><a href="{{ route('logout') }}">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <figure>
            <figcaption>
                <h1>Modifier mon profil</h1>
                <form action="{{ route('update_profil', ['id' => $collaborateur->id]) }}" method="post">
                    @csrf
                    @method('POST')
                    <label for="nom">Nom :
                        <input id="nom" name="nom" type="text" placeholder="{{ $collaborateur->nom }}">
                    </label>
                    <label for="prenom">Prénom :
                        <input id="prenom" name="prenom" type="text" placeholder="{{ $collaborateur->prenom }}">
                    </label>
                    <label for="email">Email :
                        <input id="email" name="email" type="text" placeholder="{{ $collaborateur->email }}">
                    </label>
                    <label for="mdp">Mot de passe :
                        <input id="mdp" name="mdp" type="password" placeholder="Nouveau mot de passe">
                    </label>
                    <label for="mdp_c">Confirmation :
                        <input id="mdp_c" name="mdp_c" type="password" placeholder="Confirmer le mot de passe">
                    </label>
                    <label for="telephone">Téléphone :
                        <input id="telephone" name="telephone" type="text" placeholder="{{ $collaborateur->telephone }}">
                    </label>
                    <label for="naissance">Date de naissance :
                        <input id="naissance" name="naissance" type="text" placeholder="{{ $collaborateur->date_naissance }}">
                    </label>
                    <label for="adresse">Adresse :
                        <input id="adresse" name="adresse" type="text" placeholder="{{ $collaborateur->adresse }}">
                    </label>
                    <label for="ville">Ville :
                        <input id="ville" name="ville" type="text" placeholder="{{ $collaborateur->ville }}">
                    </label>
                    <label for="photo">URL de la photo :
                        <input id="photo" name="photo" type="text" placeholder="{{ $collaborateur->photo }}">
                    </label>
                    <button type="submit">Modifier le profil</button>
                </form>
            </figcaption>
        </figure>
    </main>
    <footer>

    </footer>
    <script type="module" src="{{ Vite::asset('resources/js/verif.js') }}"></script>
</body>
</html>
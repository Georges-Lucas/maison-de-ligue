<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/modification.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('liste_utilisateur')}}">Liste</a></li>
                @if(session('collaborateur_id'))
                    @php
                        $collaborateurConnecte = \App\Models\Collaborateur::find(session('collaborateur_id'));
                    @endphp
                    @if($collaborateurConnecte && $collaborateurConnecte->is_admin)
                        <li><a href="{{ route('store_utilisateur') }}">Inscription</a></li>
                    @endif
                @endif
                <li><a href="{{ route('edit') }}"><img src="{{ asset('asset/utilisateur.png') }}" alt=""></a></li>
                <li><a href="{{ route('logout') }}">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <figure>
            <figcaption>
                <h1>Inscription</h1>
                @if($errors->any())
                    <div>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('store_utilisateur') }}" method="post">
                    @csrf
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
                    <label for="mdp_c">Confirmation :
                        <input id="mdp_c" name="mdp_confirmation" type="password" required>
                    </label>
                    <label for="telephone">Téléphone :
                        <input id="telephone" name="telephone" type="text">
                    </label>
                    <label for="naissance">Date de naissance :
                        <input id="naissance" name="naissance" type="date">
                    </label>
                    <label for="adresse">Adresse :
                        <input id="adresse" name="adresse" type="text">
                    </label>
                    <label for="ville">Ville :
                        <input id="ville" name="ville" type="text">
                    </label>
                    <label for="photo">URL de la photo :
                        <input id="photo" name="photo" type="text">
                    </label>
                    <label for="rôle">Rôle :
                        <input id="rôle" name="rôle" type="text" required>
                    </label>
                    <label for="is_admin">
                        <input id="is_admin" name="is_admin" type="checkbox" value="1">
                        Administrateur
                    </label>
                    <button type="submit">Crée utilisateur</button>
                </form>
            </figcaption>
        </figure>
    </main>
    <footer>
    </footer>
    <script type="module" src="{{ Vite::asset('resources/js/verif.js') }}"></script>
</body>
</html>
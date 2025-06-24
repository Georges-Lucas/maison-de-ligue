<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste collaborateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{Vite::asset('resources/css/liste.css')}}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('liste_utilisateur')}}">Liste</a></li>
                @if(isset($collaborateurConnecte) && $collaborateurConnecte->is_admin)
                    <li><a href="{{ route('store_utilisateur') }}">Inscription</a></li>
                @endif
                <li> <a href="{{ route('edit') }}"><img src="{{ asset('asset/utilisateur.png') }}" alt=""></a></li>
                <li><a href="{{ route('logout') }}">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Liste des collaborateurs</h1>
        <div class="recherche">
            <form method="GET" action="{{ route('liste_utilisateur') }}" class="recherche">
                <input type="search" name="nom" placeholder="Rechercher collaborateur" value="{{ request('nom') }}">
                <input type="text" name="categorie" placeholder="Rechercher par rôle" value="{{ request('categorie') }}">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="liste">
            @foreach($collaborateurs as $collaborateur)
                <figure>
                    <figcaption>
                        <img src="{{ $collaborateur->photo ? asset($collaborateur->photo) : '' }}" alt="">
                        <div class="info_utilisateur">
                            <p>{{ $collaborateur->prenom }} {{ $collaborateur->nom }} 
                                @if($collaborateur->date_naissance)
                                    ({{ \Carbon\Carbon::parse($collaborateur->date_naissance)->age }} ans)
                                @endif
                            </p>
                            <p><strong>Rôle :</strong> {{ $collaborateur->rôle }}</p>
                            <p>{{ $collaborateur->adresse }}, {{ $collaborateur->ville }}</p>
                            <div>
                                <img src="{{ asset('asset/email.png') }}" alt="">
                                <p>{{ $collaborateur->email }}</p>
                            </div>
                            <div>
                                <img src="{{ asset('asset/telephone.png') }}" alt="">
                                <p>{{ $collaborateur->telephone }}</p>
                            </div>
                            <div>
                                <img src="{{ asset('asset/gateau-danniversaire.png') }}" alt="">
                                <p>Anniversaire : 
                                    {{ $collaborateur->date_naissance ? \Carbon\Carbon::parse($collaborateur->date_naissance)->format('d F') : '' }}
                                </p>
                            </div>
                            @if(isset($collaborateurConnecte) && $collaborateurConnecte->is_admin)
                                <a href="{{ route('edit_collaborateur', ['id' => $collaborateur->id]) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('delete_collaborateur', ['id' => $collaborateur->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce collaborateur ?')">Supprimer</button>
                                </form>
                            @endif
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
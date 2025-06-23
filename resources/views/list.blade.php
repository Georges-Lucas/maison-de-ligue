<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{Vite::asset('resources/css/liste.css')}}">
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
        <h1>Liste des collaborateurs</h1>
        <div class="recherche">
            <input type="text">
            <label for="nom">Rechercher par :
                <input id="nom" type="search" placeholder="Nom">
            </label>
            <label for="categorie">Catégorie :
                <input type="text" id="categorie">
            </label>
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
                            <p>{{ $collaborateur->ville }}, {{ $collaborateur->pays ?? '' }}</p>
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
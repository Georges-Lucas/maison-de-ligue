<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection réussie</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{Vite::asset('resources/css/accueil.css')}}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="./liste_utilisateur.html">Liste</a></li>
                <li> <a href="{{route('edit')}}"><img src="" alt="PP"></a></li>
                <li><a href="../index.html">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h1>Bienvenue sur l'intranet</h1>
            <p>La plate-forme qui vous permet de retrouver tous vos collaborateur</p>
            <figure>
                <figcaption>
                    <img src="{{ $collaborateur->photo ? asset($collaborateur->photo) : '' }}" alt="">
                    <div class="info_utilisateur">
                        <p class="nom_utilisateur">
                            {{ $collaborateur->prenom }} {{ $collaborateur->nom }}
                            @if($collaborateur->date_naissance)
                                ({{ \Carbon\Carbon::parse($collaborateur->date_naissance)->age }} ans)
                            @endif
                        </p>
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
                            <p>Anniversaire : {{ $collaborateur->date_naissance ? \Carbon\Carbon::parse($collaborateur->date_naissance)->format('d F') : '' }}</p>
                        </div>
                    </div>
                </figcaption>
            </figure>
            <button><a href="./liste_utilisateur.html">DIRE BONJOUR A QUELQU'UN D'AUTRE</a></button>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>
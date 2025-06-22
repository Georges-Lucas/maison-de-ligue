<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Aguafina+Script&family=Caudex:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{Vite::asset('resources/css/accueil.css')}}">
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('connect')}}" method="post">
                @csrf
                <label for="mail">Email :</label>
                <input type="email" name="mail" id="mail" required>
                <label for="mail">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" required>
                <button type="submit">Connexion</button>
            </form>
           
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>
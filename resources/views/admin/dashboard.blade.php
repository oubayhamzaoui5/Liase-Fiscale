<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tableau de bord administration</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

</head>

<body>
    <div class="overlay" id="overlay">
        <div class="loader" id="loader"></div>
    </div>

    <div class="container">
        <div class="header">
            <div class="logo-title">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" />
                </div>
                <div class="title">Tableau de bord administration</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">déconnexion</button>
            </form>
        </div>
        <br><br>
        <h2>Contribuables:</h2>
        <br>
        <table>
            <thead>
                <tr>
                    
                    <th>Matricule_fiscale</th>
                    <th>Raison_sociale</th>
                    <th>Dépot en cours</th>
                    <th>Dépot Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contribuables as $contribuable)
                    <tr>
                        <td>{{ $contribuable->matricule_fiscale }}</td>
                        <td>{{ $contribuable->raison_sociale }}</td>
                        <td class="en_cours">{{ $contribuable->depots()->where('situation', 'en cours')->count() }}</td>
                        <td>{{ $contribuable->depots()->count() }}</td>
                        <td><a href="{{ route('admin.contribuable.depots', $contribuable->id) }}">en savoir plus</a></td>                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const overlay = document.getElementById("overlay");
        const loader = document.getElementById("loader");
        function showLoader() {
            overlay.style.display = "block";
            loader.style.display = "block";
        }

        function hideLoader() {
            setTimeout(() => {
                overlay.style.display = "none";
                loader.style.display = "none";
            }, 2000); // Delay of 1 second
        }
        showLoader();
        hideLoader();
    </script>
</body>

</html>

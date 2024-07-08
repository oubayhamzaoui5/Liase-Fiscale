<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Depots de {{ $contribuable->raison_sociale }}</title>
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
                <div class="title">Dépôts de {{ $contribuable->raison_sociale }}</div>
                
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">déconnexion</button>
            </form>
        </div>
        <br><br>
        <h3><a href="{{ route('admin.dashboard') }}">Tableau de bord administration</a></h3>
        <br>
        <h2>Dépôts:</h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Type de déclaration</th>
                    <th>Exercice</th>
                    <th>Nature</th>
                    <th>Type</th>
                    <th>Situation</th>
                    <th>Date de dépôt</th>
                    <th colspan="2"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($depots as $depot)
                    <tr>
                        <td>{{ $depot->declaration_type }}</td>
                        <td>{{ $depot->exercice }}</td>
                        <td>{{ $depot->nature }}</td>
                        <td>{{ $depot->type }}</td>
                        <td class="{{ str_replace(' ', '_', $depot->situation) }}">{{ ucfirst($depot->situation) }}
                        </td>
                        <td>{{ $depot->created_at->format('d/m/Y H:i') }}</td>
                        <td><a href="{{ route('depot.show', $depot->id) }}">En savoir plus</a></td>
                        <td>
                            <form action="{{ route('depot.destroy', $depot->id) }}" method="POST"  onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="color: red; background: none; border: none; cursor: pointer; font-weight:bold;font-size:16px;">✘</button>
                            </form>
                        </td>

                    </tr>
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
            }, 1000); // Delay of 1 second
        }
        showLoader();
        hideLoader();
        function confirmDelete() {
            return confirm('Êtes-vous sûr de vouloir supprimer ce dépôt ?');
        }
    </script>
</body>

</html>

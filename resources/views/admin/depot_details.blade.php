<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails du dépôt</title>
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
                <div class="title">Dépôt de {{ $contribuable->raison_sociale }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">déconnexion</button>
            </form>
        </div>
        <br>
        <h3><a href="{{ route('admin.dashboard') }}">Tableau de bord administration</a></h3>
        <br><br>
        <h3><a href="{{ route('admin.contribuable.depots', $depot->contribuable_id) }}">Retour</a></h3>
        <br>
        <h2>Dépôt Détails:</h2>
        <br>
        <table>
            <tr>
                <th>Type de déclaration:</th>
                <td>{{ $depot->declaration_type }}</td>
            </tr>
            <tr>
                <th>Exercice:</th>
                <td>{{ $depot->exercice }}</td>
            </tr>
            <tr>
                <th>Nature:</th>
                <td>{{ $depot->nature }}</td>
            </tr>
            <tr>
                <th>Type:</th>
                <td>{{ $depot->type }}</td>
            </tr>
            <tr>
                <th>Situation:</th>
                <td class="{{ str_replace(' ', '_', $depot->situation) }}">{{ ucfirst($depot->situation) }}</td>
            </tr>
            <tr>
                <th>Date de dépôt:</th>
                <td>{{ $depot->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @foreach (['bilan_actif', 'bilan_passif', 'etat_resultat', 'flux_tresorerie', 'resultat_fiscal_partiel', 'faits_marquants', 'autres_feuilles'] as $fileField)
                @if ($depot->$fileField)
                    <tr>
                        <th>{{ ucwords(str_replace('_', ' ', $fileField)) }}:</th>
                        <td><a href="{{ asset($depot->$fileField) }}" download>Télecharger</a></td>
                    </tr>
                @endif
            @endforeach
            @if ($depot->reception)
                <tr>
                    <th style="color : #37375C; font-weight:bold;font-size:19px;">Réception:</th>
                    <td><a href="{{ asset($depot->reception) }}" download>Télécharger</a></td>
                </tr>
            @endif
        </table>

        <div class="actions">
            @if ($depot->situation == 'en cours')
            <div class="forms">
                <form action="{{ route('depot.approve', $depot->id) }}" method="POST" style="display:inline;" enctype="multipart/form-data" onsubmit="return confirmApprove()">
                    @csrf
                    <div class="formaprov">
                        <button type="submit" class="approve-button">✔ Approuver</button>
                        <label for="reception">Télécharger le PDF de réception:</label>

                        <input type="file" name="reception" id="reception" accept="application/pdf" required>
                    </div>
                </form>
                <form action="{{ route('depot.decline', $depot->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDecline()">
                    @csrf
                    <button type="submit" class="decline-button">✘ Refuser</button>
                </form>
            </div>
            @else
                <button type="button" class="approve-button" disabled>✔ Approuver</button>
                <button type="button" class="decline-button" disabled>✘ Refuser</button>
            @endif
        </div>
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

        function confirmApprove() {
            return confirm('Êtes-vous sûr de vouloir approuver ce dépôt ?');
        }

        function confirmDecline() {
            return confirm('Êtes-vous sûr de vouloir refuser ce dépôt ?');
        }

        showLoader();
        hideLoader();
    </script>
</body>

</html>

<div>
    <table>
        <thead>
            <tr>
                <th>Groupe des documents</th>
                <th>Situation dépôt</th>
                <th>Exercice</th>
                <th>Nature dépôt</th>
                <th>Provisoire / Definitif</th>
                <th>Date dépôt</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($depots as $depot)
                    <tr>
                        <td>{{ $depot->declaration_type }}</td>
                        <td class="{{ str_replace(' ', '_', $depot->situation) }}">{{ ucfirst($depot->situation) }}</td>
                        <td>{{ $depot->exercice }}</td>
                        <td>{{ $depot->nature }}</td>
                        <td>{{ $depot->type }}</td>
                        <td>{{ $depot->created_at->format('d/m/Y H:i') }}</td>
                        @if ($depot->reception)
                        <td>
                            <a href="{{ asset($depot->reception) }}" download class="pdf-button">
                                <i class="fa fa-file-pdf-o"></i>
                                Accusé de réception
                        </td>
                        @else
                        <td>
                            <a download class="pdf-button">
                                <i class="fa fa-file-pdf-o"></i>
                                Accusé de réception
                        </td>
                        @endif

                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

<div>
    <a href="{{ route('candidato.crear') }}" class="btn btn-primary mb-2">Crear Candidato</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Encuestas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
                <tr>
                    <td>{{ $candidato->nombre }}</td>
                    <td>{{ $candidato->descripcion }}</td>
                    <td>
                        @if ($candidato->encuestas->isNotEmpty())
                            <ul class="mb-0">
                                @foreach ($candidato->encuestas as $encuesta)
                                    <li>{{ $encuesta->titulo }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No asignado</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('candidato.editar', $candidato->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

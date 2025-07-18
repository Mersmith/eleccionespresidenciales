<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Encuestas</h1>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Título</th>
                <th class="border px-4 py-2">Categoría</th>
                <th class="border px-4 py-2">Inicio</th>
                <th class="border px-4 py-2">Fin</th>
                <th class="border px-4 py-2">Activa</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($encuestas as $encuesta)
                <tr>
                    <td class="border px-4 py-2">{{ $encuesta->id }}</td>
                    <td class="border px-4 py-2">{{ $encuesta->titulo }}</td>
                    <td class="border px-4 py-2">{{ $encuesta->categoria->nombre ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $encuesta->fecha_inicio }}</td>
                    <td class="border px-4 py-2">{{ $encuesta->fecha_fin }}</td>
                    <td class="border px-4 py-2">
                        @if($encuesta->activa)
                            ✅
                        @else
                            ❌
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('encuesta.editar', $encuesta->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <a href="{{ route('encuesta.candidato.lista', $encuesta->id) }}" class="text-blue-600 hover:underline">Candidatos</a>
                        <a href="{{ route('encuesta.votacion', $encuesta->id) }}" class="text-blue-600 hover:underline">Votacion</a>
                        <a href="{{ route('encuesta.resultado', $encuesta->id) }}" class="text-blue-600 hover:underline">Resultados</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No hay encuestas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

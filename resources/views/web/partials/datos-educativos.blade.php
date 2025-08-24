@if (
    (!empty($datos['formaciones']) && collect($datos['formaciones'])->filter(fn($f) => !empty($f['formacion']) || !empty($f['universidad']))->isNotEmpty())
    || (!empty($datos['cursos_adicionales']) && collect($datos['cursos_adicionales'])->filter(fn($c) => !empty($c))->isNotEmpty())
)
    <div class="g_card_panel g_margin_bottom_20">
        <h3 class="g_texto_nivel_4">DATOS EDUCATIVOS</h3>

        {{-- Formaciones --}}
        @if (!empty($datos['formaciones']))
            @php
                $formaciones = collect($datos['formaciones'])->filter(fn($f) => !empty($f['formacion']) || !empty($f['universidad']));
            @endphp
            @if ($formaciones->isNotEmpty())
                <h4 class="g_texto_nivel_1">Formaciones</h4>
                <ul>
                    @foreach ($formaciones as $formacion)
                        <li>
                            <i class="fa-solid fa-user-graduate"></i>
                            {{ $formacion['formacion'] ?? 'Sin formación' }}
                            - {{ $formacion['universidad'] ?? 'Sin universidad' }}
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif

        <br>

        {{-- Cursos adicionales --}}
        @if (!empty($datos['cursos_adicionales']))
            @php
                $cursos = collect($datos['cursos_adicionales'])->filter(fn($c) => !empty($c));
            @endphp
            @if ($cursos->isNotEmpty())
                <h4 class="g_texto_nivel_1">Cursos adicionales</h4>
                <ul>
                    @foreach ($cursos as $curso)
                        <li><i class="fa-solid fa-brain"></i> {{ $curso }}</li>
                    @endforeach
                </ul>
            @endif
        @endif
    </div>
@endif

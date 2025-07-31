<div class="contenedor_pagina_candidato">
    <div class="centrar">
        <div class="contenedor_bloque">
            <div class="grid_pagina_candidato">
                <!-- INFORMACION -->
                <div class="columna_informacion">
                    <div class="contenedor_encuesta_resultado">
                        <h1 class="titulo">{{ $encuesta->nombre }}</h1>
                        <p class="descripcion">{{ $encuesta->descripcion }}</p>

                        @php
                            $totalVotos = $resultados->sum('votos');
                        @endphp

                        <p class="total-votos">Total de votos: <strong>{{ $totalVotos }}</strong></p>

                        @foreach ($resultados as $item)
                            @php
                                $porcentaje = $totalVotos > 0 ? round(($item['votos'] / $totalVotos) * 100, 2) : 0;
                            @endphp
                            <div class="candidato-item">
                                <div class="foto-contenedor">
                                    <img src="{{ $item['candidato_foto'] }}" alt="Candidato" class="foto-candidato">
                                    <img src="{{ $item['partido_foto'] }}" alt="Partido" class="logo-partido">
                                </div>
                                <div class="info-candidato">
                                    <div class="nombre-candidato">{{ $item['candidato_nombre'] }}</div>
                                    <div class="nombre-partido">{{ $item['partido_nombre'] }}</div>
                                    <div class="barra-voto">
                                        <div class="barra-progreso" style="width: {{ $porcentaje }}%"></div>
                                    </div>
                                </div>
                                <div class="votos-dato">
                                    <div class="cantidad-votos">{{ $item['votos'] }} votos</div>
                                    <div class="porcentaje">{{ $porcentaje }}%</div>
                                </div>
                            </div>
                        @endforeach



                        <div class="barra_ga">
                            @php
                                $totalVotos = $resultados->sum('votos');
                            @endphp

                            <p class="total-votos">Total de votos: <strong>{{ $totalVotos }}</strong></p>

                            <div class="grafico-barras-scroll">
                                <div class="grafico">
                                    @foreach ($resultados as $item)
                                        @php
                                            $porcentaje =
                                                $totalVotos > 0 ? round(($item['votos'] / $totalVotos) * 100, 2) : 0;
                                        @endphp
                                        <div class="barra-container">
                                            <div class="barra" style="height: {{ $porcentaje }}%">
                                                <img src="{{ $item['partido_foto'] }}" class="logo" alt="Partido">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- PUBLICIDAD -->
                <div class="columna_publicidad">
                    @include('web.partials.columna-publicidad')
                </div>
            </div>
        </div>
    </div>

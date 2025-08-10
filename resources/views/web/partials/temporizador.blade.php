@if (!empty($p_elemento))
    <div x-data="dataTemporizador{{ $p_elemento->id }}('{{ $p_elemento['fecha_fin'] }}')" x-init="initTemporizador()" class="partials_contenedor_temporizador">
        <div class="contenedor_fecha_hora">
            <div class="contenedor_fecha">
                @if ($p_elemento->dias == 0)
                    <span> Esta encuesta termina HOY </span>
                @elseif ($p_elemento->dias == 1)
                    <span> Esta encuesta termina en {{ $p_elemento->dias }} día</span>
                @else
                    <span> Esta encuesta termina en {{ $p_elemento->dias }} días</span>
                @endif
            </div>

            @if ($p_elemento->dias == 0)
                <div class="contenedor_hora">
                    <template x-for="digito in padTwoDigits(hora)">
                        <p x-text="digito"></p>
                    </template>
                    <span>:</span>
                    <template x-for="digito in padTwoDigits(minuto)">
                        <p x-text="digito"></p>
                    </template>
                    <span>:</span>
                    <template x-for="digito in padTwoDigits(segundo)">
                        <p x-text="digito"></p>
                    </template>
                </div>
            @endif
        </div>

        <div class="partials_contenedor_slider_temporizador">
            <a href="{{ route('encuesta', ['id' => $p_elemento->id, 'slug' => $p_elemento->slug]) }}">
                @if ($p_elemento->imagen_url)
                    <img src="{{ $p_elemento->imagen_url }} " alt="{{ $p_elemento->nombre }}" />
                @else
                    <img src="{{ $p_elemento->eleccion?->imagen_ruta }} " alt="{{ $p_elemento->nombre }}" />
                @endif
            </a>
        </div>
    </div>

    <script>
        function dataTemporizador{{ $p_elemento->id }}(fecha_fin) {
            const fechaFinal = new Date(fecha_fin);

            return {
                dias: 0,
                hora: 0,
                minuto: 0,
                segundo: 0,

                initTemporizador() {
                    this.intervalo();

                    if (this.dias == 0) {

                        setInterval(() => {
                            this.intervalo();
                        }, 1000);
                    }
                },

                intervalo() {
                    const ahora = new Date();
                    const tiempoRestante = Math.floor((fechaFinal - ahora) / 1000);

                    if (tiempoRestante > 0) {
                        this.dias = Math.floor(tiempoRestante / 86400);
                        this.hora = Math.floor(tiempoRestante / 3600) % 24;
                        this.minuto = Math.floor(tiempoRestante / 60) % 60;
                        this.segundo = tiempoRestante % 60;
                    }
                },

                padTwoDigits(valor) {
                    return valor.toString().padStart(2, '0').split('');
                },
            };
        }
    </script>
@endif

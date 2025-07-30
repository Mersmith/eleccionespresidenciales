@if (!empty($p_elemento))
    <div class="partials_contenedor_perfil_partido">
        <div class="partido_imagen_contenedor">
            <img class="imagen_partido" src="{{ $p_elemento->logo }}" alt="" />
        </div>

        <div class="nombres_partido">
            <div class="nombres">
                <div class="redes_sociales">
                    <a href="#" style="color: #1778f2">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" style="color: #cb0088">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="color: #000000">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>

                <h3>{{ $p_elemento->nombre }} </h3>
                <p>{{ $p_elemento->descripcion }} </p>
            </div>
        </div>
    </div>
@endif

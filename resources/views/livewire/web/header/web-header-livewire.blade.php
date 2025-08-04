<div x-data="xDataMenuEcommerce()" x-init="initMenuEcommerce">

    <header class="ecommerce_menu_principal">
        <!-- MENU ARRIBA -->
        <div class="menu_principal_arriba">
            <!-- LOGO COMPUTADORA -->
            <div class="logo_computadora">
                <span class="menu_hamburguesa_movil" x-on:click="toggleContenedorSidebar">
                    <i class="fa-solid fa-bars"></i>
                </span>

                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo-votmi-computadora.svg') }}" alt="Tendencias Market"
                        class="imagen_logo_computadora" />

                    <img src="{{ asset('assets/images/logo-votmi-movil.svg') }}" alt="Tendencias Market"
                        class="imagen_logo_movil" />
                </a>
            </div>

            <!-- BUSCADOR PRINCIPAL -->
            <div class="buscador_principal">
                @livewire('web.header.web-buscar-livewire')
            </div>

            <!-- MENU HAMBURGUESA COMPUTADORA -->
            <div class="menu_hamburguesa_computadora" x-on:click="toggleContenedorSidebar">
                <span>
                    <i class="fa-solid fa-bars"></i>
                </span>

                <p>Elecciones</p>
            </div>

            <!-- MENU ENLACES RAPIDOS -->
            <ul class="menu_enlaces_rapidos">
                <!-- ITEM CUENTA  -->
                @include('components.layouts.web.menu.menu')
            </ul>

            <!-- MENU PRINCIPAL USUARIOS -->
            <ul class="menu_principal_usuarios">
                <!-- ITEM CUENTA  -->
                <li>
                    <x-dropdown align="left" width="40">
                        <x-slot name="trigger">

                            <a class="principal_usuarios_item">
                                <i class="fa-regular fa-user"></i>
                                <span>Cuenta</span>
                            </a>
                        </x-slot>

                        <x-slot name="content">

                            @if (Auth::check())
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a class="dropdown_item" href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">Cerrar </a>
                                </form>
                            @else
                                <a href="#" class="dropdown_item"  wire:click="abrirModalSesion()">Login</a>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>
        </div>

        <!-- MENU ABAJO -->
        <nav class="menu_principal_abajo">
            <!-- UBICACION -->
            <div class="contenedor_menu_ubicacion">
                <i class="fa-solid fa-location-dot"></i>
                <span>Ingresa tu ubicación</span>
            </div>

            <!-- INFORMACION -->
            <ul class="contenedor_informacion">
                <li>
                    <a href="#">
                        Tu publicidad aquí
                    </a>
                </li>
                <li>
                    <a href="#">
                        Participa como candidato
                    </a>
                </li>
                <li>
                    <a href="#">
                        Contacto <i class="fa-solid fa-angle-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    @if ($cargos)
        <!-- CONTENEDOR SIDEBAR -->
        <aside class="ecommerce_sidebar_categorias"
            :class="{ 'estilo_abierto_contenedor_sidebar': estadoAsideAbierto }">
            <!-- SIDEBAR CONTENEDOR -->
            <div class="sidebar_contenedor">
                <!-- SIDEBAR CABECERA -->
                <div class="sidebar_cabecera">
                    <div class="saludo">¡Buen día!</div>

                    <span x-on:click="toggleContenedorSidebar">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>

                <!-- SIDEBAR CONTENIDO -->
                <div class="sidebar_contenido g_scroll">
                    <div class="sidebar_cotenido_item">

                        <!-- CARGOS  - NIVEL 1-->
                        <ul class="sidebar_cotenido_item_ul">
                            <h5>Cargos</h5>
                            @foreach ($cargos as $cargo)
                                <li>
                                    <div class="sidebar_cotenido_elemento"
                                        wire:click="seleccionarCargo({{ $cargo->id }})">
                                        <i class="fas fa-user-tie"></i>
                                        <a>
                                            <span>{{ $cargo->nombre }}</span>
                                            {{-- @if ($cargo->nivel_id > 1)
                                    <i class="fa-solid fa-angle-right"></i>
                                    @endif --}}
                                        </a>
                                    </div>

                                    {{-- <!-- REGIONES - NIVEL 2 -->
                            @if ($cargo_id == $cargo->id && $cargo_nivel_id >= 2 && $regiones->count())
                            <ul class="sidebar_cotenido_item_ul">
                                <h5>Regiones</h5>
                                @foreach ($regiones as $index => $region)
                                <li>
                                    <div class="sidebar_cotenido_elemento" wire:click="seleccionarRegion({{ $region->id }})">
                                        <i class="fas fa-synagogue"></i>
                                        <a href="#">
                                            <span>{{ ucwords(strtolower($region->nombre))}}</span>
                                            @if ($cargo_nivel_id >= 3)
                                            <i class="fa-solid fa-angle-right"></i>
                                            @endif
                                        </a>
                                    </div>

                                    <!-- PROVINCIAS - NIVEL 3 -->
                                    @if ($region_id == $region->id && $cargo_nivel_id >= 3 && $provincias->count())
                                    <ul class="sidebar_cotenido_item_ul">
                                        <h5>Provincias</h5>
                                        @foreach ($provincias as $index => $provincia)
                                        <li>
                                            <div class="sidebar_cotenido_elemento" wire:click="seleccionarProvincia({{ $provincia->id }})">
                                                <i class="fas fa-hotel"></i>
                                                <a href="#">
                                                    <span>{{ ucwords(strtolower($provincia->nombre))}}</span>
                                                    @if ($cargo_nivel_id >= 4)
                                                    <i class="fa-solid fa-angle-right"></i>
                                                    @endif
                                                </a>
                                            </div>

                                            <!-- DISTRITOS - NIVEL 4 -->
                                            @if ($provincia_id == $provincia->id && $cargo_nivel_id >= 4 && $distritos->count())
                                            <ul class="sidebar_cotenido_item_ul">
                                                <h5>Distritos</h5>
                                                @foreach ($distritos as $index => $distrito)
                                                <li>
                                                    <div class="sidebar_cotenido_elemento">
                                                        <i class="fas fa-city"></i>
                                                        <a href="#">
                                                            <span>{{ ucwords(strtolower($distrito->nombre))}}</span>
                                                            @if ($cargo_nivel_id >= 5)
                                                            <i class="fa-solid fa-angle-right"></i>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </li>
                                @endforeach
                            </ul>
                            @endif --}}

                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- PIE -->
                    <div class="sidebar_cotenido_item sidebar_pie">
                        <a href="#">
                            <img src="{{ asset('assets/images/logo-votmi-computadora.svg') }}"
                                alt="Tendencias Market" />
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    @endif

    @if ($modal_sesion)
        <div class="modal_sesion_overlay" wire:click.self="cerrarModalSesion">
            <div class="modal_sesion_contenido">
                <h2>Iniciar Sesión</h2>
                <a href="{{ route('auth.redirect', 'google') }}" class="boton_sesion_red">Google</a>
                <a href="{{ route('auth.redirect', 'github') }}" class="boton_sesion_red">GitHub</a>
                <a href="{{ route('auth.redirect', 'facebook') }}" class="boton_sesion_red">Facebook</a>
                <button wire:click="cerrarModalSesion" class="boton_cerrar_modal">Cerrar</button>
            </div>
        </div>
    @endif

</div>

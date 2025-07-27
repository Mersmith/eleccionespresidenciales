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
                    <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-computadora.svg') }}"
                        alt="Tendencias Market" class="imagen_logo_computadora" />

                    <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-movil.svg') }}"
                        alt="Tendencias Market" class="imagen_logo_movil" />
                </a>
            </div>

            <!-- BUSCADOR PRINCIPAL -->
            <div class="buscador_principal">
                <div class="contenedor_input_buscador_principal">
                    <input type="text" placeholder="Busca las mejores Tendencias" name="buscar_producto"
                        id="buscar_producto" />
                </div>

                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <!-- MENU HAMBURGUESA COMPUTADORA -->
            <div class="menu_hamburguesa_computadora" x-on:click="toggleContenedorSidebar">
                <span>
                    <i class="fa-solid fa-bars"></i>
                </span>

                <p>Categorias</p>
            </div>

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
                            <div class="g_dropdown">
                                @if (Auth::check() && Auth::user()->hasRole('comprador'))
                                    <a class="dropdown_item" href="{{ route('comprador.perfil.vista.ver') }}">
                                        Perfil</a>

                                    <a class="dropdown_item" href="{{ route('comprador.compra.vista.ver') }}">Mis
                                        compras</a>

                                    <a class="dropdown_item"
                                        href="{{ route('comprador.direccion.vista.ver') }}">Direcciones</a>

                                    <a class="dropdown_item"
                                        href="{{ route('comprador.reembolso.vista.ver') }}">Reembolso</a>

                                    <a class="dropdown_item"
                                        href="{{ route('comprador.favorito.vista.ver') }}">Favoritos</a>

                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <a class="dropdown_item" href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">Cerrar </a>
                                    </form>
                                @else
                                    <a href="{{ route('comprador.login.vista.ver') }}" class="dropdown_item">Login</a>

                                    <a href="#" class="dropdown_item">Registrarse</a>
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </li>

                <!-- ITEM FAVORITOS -->
                <li>
                    <a href="#" class="principal_usuarios_item">
                        <i class="fa-regular fa-heart"></i>
                        <span>Favoritos</span>
                    </a>
                </li>

                <!-- ITEM PUNTOS  -->
                <li>
                    <a href="#" class="principal_usuarios_item">
                        <i class="fa-regular fa-circle-dot"></i>
                        <span>Puntos</span>
                    </a>
                </li>

                <!-- ITEM CARRITO  -->
                <li class="menu_carrito">
                    <a href="{{ route('comprador.carrito.vista.ver') }}" class="principal_usuarios_item">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Carrito</span>
                        @livewire('ecommerce.menu.menu-carrito-livewire')
                    </a>
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
                        Vende en Tendendecias
                    </a>
                </li>
                <li>
                    <a href="#">
                        Acumula puntos
                    </a>
                </li>
                <li>
                    <a href="#">
                        Venta telefónica
                    </a>
                </li>
                <li>
                    <a href="#">
                        Cupones
                    </a>
                </li>
                <li>
                    <a href="#">
                        Asesor <i class="fa-solid fa-angle-down"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    @if ($categorias)
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
                <div class="sidebar_contenido">
                    <!-- CATEGORIAS -->
                    <div class="sidebar_cotenido_item">
                        <ul class="sidebar_cotenido_item_ul">
                            <h5>Categorias</h5>
                            @foreach ($categorias as $categoria)
                                <li x-on:click="toggleContenedorSidebarSubcategorias({{ json_encode($categoria) }})">
                                    <!-- SIDEBAR CONTENIDO ELEMENTO -->
                                    <div class="sidebar_cotenido_elemento">
                                        @if ($categoria['subcategorias'])
                                            <span>{{ $categoria['nombre'] }}</span>
                                            <i class="fa-solid fa-angle-right"></i>
                                        @else
                                            <a href="{{ $categoria['url'] }} ">
                                                <span>{{ $categoria['nombre'] }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- PIE -->
                    <div class="sidebar_cotenido_item sidebar_pie">
                        <a href="#">
                            <img src="{{ asset('assets/ecommerce/imagenes/logo/tendendecias-market-logo-computadora.svg') }}"
                                alt="Tendencias Market" />
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- CONTENEDOR SUBCATEGORIAS -->
        <nav class="contenedor_sidebar_subcategorias" :x-show="estadoNavSubcategoriasAbierto">
            <!-- SIDEBAR CONTENEDOR -->
            <div class="sidebar_contenedor">
                <!-- SIDEBAR CABECERA -->
                <div class="sidebar_cabecera">
                    <div class="retroceder" x-on:click="cerrarSidebarSubcategorias">
                        <i class="fa-solid fa-angle-left"></i>
                        <span>Retroceder</span>
                    </div>

                    <span x-on:click="cerrarSidebars">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>

                <div class="sidebar_cabecera_categoria">
                    <a :href="dataSubMenu1.url" x-text="dataSubMenu1.nombre"></a>
                    <i class="fa-solid fa-angle-right"></i>
                </div>

                <!-- SIDEBAR CONTENIDO -->
                <div class="sidebar_contenido">
                    <div class="sidebar_cotenido_item">
                        <ul class="sidebar_cotenido_item_ul">
                            <template x-for="subcategoria in dataSubMenu1.subcategorias" :key="subcategoria.id">
                                <li>
                                    <!-- SIDEBAR CONTENIDO ELEMENTO  -->
                                    <div class="sidebar_cotenido_elemento">
                                        <a :href="subcategoria.url" class="sidebar_cotenido_elemento_imagen">
                                            <div class="sidebar_contenedor_imagen">
                                                <img :src="subcategoria.imagen_url ? subcategoria.imagen_url :
                                                    '{{ asset('assets/imagenes/producto/producto-tipo-1-1.jpg') }}'"
                                                    alt="">
                                            </div>
                                            <span x-text="subcategoria.nombre"></span>
                                        </a>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    @endif

</div>

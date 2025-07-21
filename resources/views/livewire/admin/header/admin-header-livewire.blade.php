<header class="header_layout_pagina">
    <span class="layout_menu_hamburguesa_celular" x-on:click="toggleContenedorAside"><i
            class="fa-solid fa-bars"></i></span>
    <div>
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <a href="{{ route('logout') }}" @click.prevent="$root.submit();"><i class="fa-solid fa-power-off"></i> Cerrar</a>
        </form>
    </div>
</header>
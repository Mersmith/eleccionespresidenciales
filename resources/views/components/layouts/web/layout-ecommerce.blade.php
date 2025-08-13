<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!--META TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('descripcion')">

    <!--TITULO-->
    <title>@yield('tituloPagina')</title>

    {{-- Meta SEO Facebook y Twitter --}}
    <meta property="og:title" content="@yield('tituloPagina', 'VotaXmi')" />
    <meta property="og:description" content="@yield('descripcion', 'Participa y apoya a tu candidato favorito.')" />
    <meta property="og:image" content="@yield('meta_image', asset('default-image.jpg'))" />
    <meta property="og:type" content="website" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('tituloPagina', 'VotaXmi')" />
    <meta name="twitter:description" content="@yield('descripcion', 'Participa y apoya a tu candidato favorito.')" />
    <meta name="twitter:image" content="@yield('meta_image', asset('default-image.jpg'))" />

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#392385" />

    <!-- SCRIPTS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- STYLES -->
    @livewireStyles
    @include('components.layouts.web.assets.css')

    <!-- Google tag (gtag.js) -->
    @if (app()->environment('production'))
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-KN7R7YC98Z"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-KN7R7YC98Z');
        </script>
    @endif
</head>

<body class="contenedor_layout_web">


    <div x-data="xDataLayoutEcommerce()" x-init="initLayoutEcommerce">
        <!--MENU PRINCIPAL-->
        @livewire('web.header.web-header-livewire')

        <!--CONTENEDOR LAYOUT GENERAL-->
        <main class="contenedor_layout_web_pagina">
            @yield('content')
            @if (isset($slot))
                {{ $slot }}
            @endif
        </main>

        <div class="contenedor_superponer" :x-show="estadoSuperponer" x-on:click="cerrarTodo"></div>
    </div>

    <!--SCRIPTS-->
    @include('components.layouts.web.assets.js')

    @stack('modals')
    @livewireScripts
    @stack('script')
    <script>
        @if (session('alerta'))
            window.onload = function() {
                let mensaje = @json(session('alerta'));
                alertaNormal(mensaje);
            };
        @endif

        Livewire.on('alertaLivewire', mensaje => {
            if (mensaje == 'Creado' || mensaje == 'Actualizado') {
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    showConfirmButton: false,
                    timer: 2500
                })
            } else if (mensaje == "Error") {
                Swal.fire({
                    icon: 'error',
                    title: '¡Alto!',
                    text: mensaje,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        })
    </script>
</body>

</html>

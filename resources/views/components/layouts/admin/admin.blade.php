<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @livewireStyles
</head>
<body>

    <!-- Header -->
    <header class="header">
        <h1 class="logo">Panel Administrativo</h1>
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    </header>

    <!-- Layout -->
    <div class="layout">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <ul>
                <li><a href="{{ route('admin.categoria') }}">Categorías</a></li>
                <li><a href="{{ route('admin.encuesta.lista') }}">Encuestas</a></li>
                <li><a href="{{ route('admin.candidato.lista') }}">Candidatos</a></li>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>

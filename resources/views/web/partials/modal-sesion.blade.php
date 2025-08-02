<div class="modal_sesion_overlay">
    <div class="modal_sesion_contenido">
        <h2>Iniciar Sesión</h2>
        <a href="{{ route('auth.redirect', 'google') }}" class="boton_sesion_red">Google</a>
        <a href="{{ route('auth.redirect', 'github') }}" class="boton_sesion_red">GitHub</a>
        <a href="{{ route('auth.redirect', 'facebook') }}" class="boton_sesion_red">Facebook</a>
        <button wire:click="cerrarModalSesion" class="boton_cerrar_modal">Cerrar</button>
    </div>
</div>

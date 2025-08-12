@php
    $url = $url ?? url()->current();
    $title = $title ?? 'VotaXmi';
    $description = $description ?? 'Participa y apoya a tu candidato favorito.';
    $image = $image ?? asset('default-image.jpg');

    $text = urlencode("{$title} - {$description}");
    $encodedUrl = urlencode($url);
    $encodedImage = urlencode($image);
@endphp

<div class="compartir_redes">

    <p>📢 Comparte con tus amigos:</p>

    <div>
        {{-- Facebook usa solo la url, pero con meta tags la imagen se muestra --}}
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" target="_blank"
            rel="noopener noreferrer" aria-label="Compartir en Facebook" class="btn-compartir facebook">
            <i class="fa-brands fa-facebook"></i> Facebook
        </a>

        <a href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $text }}" target="_blank"
            rel="noopener noreferrer" aria-label="Compartir en Twitter" class="btn-compartir twitter">
            <i class="fa-brands fa-x-twitter"></i> Twitter
        </a>

        <a href="https://wa.me/?text={{ $text }}%20{{ $encodedUrl }}" target="_blank"
            rel="noopener noreferrer" aria-label="Compartir en WhatsApp" class="btn-compartir whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
    </div>
</div>

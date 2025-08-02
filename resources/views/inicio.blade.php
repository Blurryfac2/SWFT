@extends('layouts.app')

@section('title', 'Inicio')

@section('content')


<!-- SLIDER A PANTALLA COMPLETA -->
<div class="hero-slider">
    <div class="hero-slide active" style="background-image: url('{{ asset('img/WhatsApp Image 2025-06-18 at 9.45.42 AM (2).jpeg') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('img/WhatsApp Image 2025-06-18 at 9.45.42 AM (3).jpeg') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('img/WhatsApp Image 2025-06-18 at 9.45.43 AM.jpeg') }}');"></div>
    <div class="hero-slide" style="background-image: url('{{ asset('img/WhatsApp Image 2025-06-18 at 9.45.43 AM (2).jpeg') }}');"></div>

    <div class="hero-content">
        <p>ESPECIALISTAS EN PIROTECNIA</p>
        <h1>ILUMINANDO EL CIELO</h1>
    </div>
</div>

<!-- SCRIPT PARA SLIDER -->
<script>
    const slides = document.querySelectorAll('.hero-slide');
    let index = 0;
    setInterval(() => {
        slides[index].classList.remove('active');
        index = (index + 1) % slides.length;
        slides[index].classList.add('active');
    }, 5000);
</script>

<!-- INFORMACIÓN Y VIDEO IGUALADOS -->
<section class="info-section">
    <div class="video-text-row">
        <!-- VIDEO -->
        <div class="video-box">
            <video controls autoplay muted>
                <source src="{{ asset('videos/pirotecnia.mp4') }}" type="video/mp4">
                Tu navegador no soporta video HTML5.
            </video>
        </div>

        <!-- TEXTO -->
        <div class="text-box">
            <div>
                <h3 class="fw-bold text-danger">No es la edad... es la mentalidad</h3>
                <p class="mt-3" style="font-size: 1.1rem; line-height: 1.7;">
                    En un mundo lleno de opciones, entendemos que <strong>no fuimos los primeros</strong><br>
                    ni somos los únicos...<br>
                    pero por eso mismo, <strong class="text-danger">decidimos ser los mejores</strong>.
                </p>
                <p style="font-size: 1.05rem;">
                    Cada chispa, cada explosión en el cielo no es solo un espectáculo: es pasión, historia y compromiso.
                </p>
                <hr>
                <h5 class="fw-semibold">¿Qué encontrarás en este sitio?</h5>
                <ul class="mt-2">
                    <li>🎆 Galerías espectaculares de pirotecnia</li>
                    <li>🎯 Servicios únicos para cada ocasión</li>
                    <li>💡 Creatividad, innovación y seguridad</li>
                    <li>📞 Atención clara y profesional</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

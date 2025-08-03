<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienvenido - Especialistas en Pirotecnia</title>
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
</head>
<body>
    
    <div class="particles" id="particles"></div>

    <div class="page-wrapper">
        @include('components.header')

        @if($carouselImages->count())
        <section class="hero" id="hero-carousel">
            @foreach ($carouselImages as $index => $image)
            <img
                src="{{ asset('storage/' . $image->image_path) }}"
                alt="{{ $image->title }}"
                class="carousel-slide{{ $index === 0 ? ' active' : '' }}">
            @endforeach

            <!--animaciones no tocar dont touch -->
            <div class="firework"></div>
            <div class="firework"></div>
            <div class="firework"></div>
            <div class="firework"></div>

            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p>ESPECIALISTAS EN PIROTECNIA</p>
                <h1>ILUMINANDO EL CIELO</h1>
            </div>

            <div class="scroll-indicator">↓</div>
        </section>
        @else
        <section class="hero" id="hero-carousel">
            <img src="{{ asset('img/2.jpg') }}" alt="Iluminando el cielo" class="carousel-slide active">
            <img src="{{ asset('img/3.png') }}" alt="Iluminando el cielo" class="carousel-slide">

           
            <div class="firework"></div>
            <div class="firework"></div>
            <div class="firework"></div>
            <div class="firework"></div>

            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p>ESPECIALISTAS EN PIROTECNIA</p>
                <h1>ILUMINANDO EL CIELO</h1>
            </div>

            <div class="scroll-indicator">↓</div>
        </section>
        @endif

        <main>
            <div class="grid">
                <div class="video-container">
                    <video class="video" controls autoplay muted loop>
                        <source src="{{ asset('videos/pirotecnia.mp4') }}" type="video/mp4">
                        Tu navegador no soporta video HTML5.
                    </video>
                </div>

                <div class="contenido-principal">
                    <h3>No es la edad... es la mentalidad</h3>
                    
                    <p>
                        En un mundo lleno de opciones, entendemos que <strong>no fuimos los primeros</strong><br>
                        ni somos los únicos...<br>
                        pero por eso mismo, <strong class="rojo">decidimos ser los mejores</strong>.
                    </p>

                    <p>
                        Cada chispa, cada explosión en el cielo no es solo un espectáculo: es pasión, historia y compromiso.
                    </p>

                    <hr>

                    <h5>¿Qué encontrarás en este sitio?</h5>

                    <ul>
                        <li>🎆 Galerías espectaculares de pirotecnia</li>
                        <li>🎯 Servicios únicos para cada ocasión</li>
                        <li>💡 Creatividad, innovación y seguridad</li>
                        <li>📞 Atención clara y profesional</li>
                    </ul>
                </div>
            </div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>

    <script>
        // esto pertenece a animaciones 
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const numberOfParticles = 50;

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                particlesContainer.appendChild(particle);
            }
        }

      
        document.addEventListener("DOMContentLoaded", function() {
            
            createParticles();

            
            const slides = document.querySelectorAll("#hero-carousel .carousel-slide");
            let current = 0;

            if (slides.length > 1) {
                setInterval(() => {
                    slides[current].classList.remove("active");
                    current = (current + 1) % slides.length;
                    slides[current].classList.add("active");
                }, 5000);
            }

            
            const scrollIndicator = document.querySelector('.scroll-indicator');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    const main = document.querySelector('main');
                    if (main) {
                        main.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }
        });

        
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            
            if (hero) {
                const speed = scrolled * 0.3;
                hero.style.transform = `translateY(${speed}px)`;
            }
        });

       
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.video-container, .contenido-principal');
            elements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
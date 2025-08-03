<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra Historia - Pirotecnia FR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Partículas animadas de fondo -->
    <div class="particles" id="particles"></div>

    <div class="page-wrapper">
        @include('components.header')

        <main>
            <!-- Hero Section -->
            <div class="historia-hero">
                <br><br>
                <h1>NUESTRA HISTORIA</h1>
                <p>30 años iluminando el cielo mexicano</p>
            </div>

            <section id="historia-vision-mision">
                <!-- Contenedor principal de historia -->
                <div class="historia-main-container">
                    <div class="historia-image-container">
                        <img src="{{ asset('img/historia.png') }}"
                            alt="Historia de la Pirotecnia FR"
                            class="historia-image">
                    </div>
                    
                    <div class="historia-content">
                        <h2 class="historia-title">
                            Acerca de nosotros
                        </h2>
                        <div class="historia-text-container">
                            <p class="historia-text">
                                En <span class="historia-highlight">Pirotecnia FR</span> llevamos más de 30 años iluminando los cielos de México y creando momentos inolvidables.
                                Somos una empresa familiar, nacida de la pasión por el arte pirotécnico, transmitida de generación en generación como un verdadero legado.
                            </p>
                            <p class="historia-text">
                                Nuestros inicios fueron 100% artesanales: elaborábamos cada pieza con materiales tradicionales, como el carrizo, y dedicábamos horas a perfeccionar cada detalle.
                                Con el paso del tiempo, hemos abrazado la innovación tecnológica, evolucionando desde esos procesos manuales hasta lograr espectáculos piromusicales,
                                donde la música y el fuego se sincronizan para crear experiencias visuales realmente únicas.
                            </p>
                            <p class="historia-text">
                                Hoy, nuestra pirotecnia representa una historia viva de creatividad, innovación y respeto por la tradición. En cada evento combinamos experiencia, pasión y tecnología,
                                llevando alegría y emoción a cada celebración, siempre con la máxima seguridad y profesionalismo.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Grid de Visión y Misión -->
                <div class="vision-mision-grid">
                    <div class="vm-card vision">
                        <img src="{{ asset('img/feria.jpeg') }}"
                            class="vm-image"
                            alt="Visión">
                        <div class="vm-content">
                            <h3 class="vm-title vision">Visión</h3>
                            <p class="vm-text">
                                Ser la empresa líder en pirotecnia en México, reconocida por nuestra calidad, creatividad y compromiso con la seguridad.
                                Aspiramos a seguir marcando tendencia y dejando huella en cada cielo que iluminamos, expandiendo nuestra pasión a nuevas generaciones y rincones del país.
                            </p>
                        </div>
                    </div>

                    <div class="vm-card mision">
                        <img src="{{ asset('img/equipo.jpeg') }}"
                            class="vm-image"
                            alt="Misión">
                        <div class="vm-content">
                            <h3 class="vm-title mision">Misión</h3>
                            <p class="vm-text">
                                Brindar espectáculos pirotécnicos inolvidables, seguros y de la más alta calidad,
                                superando las expectativas de nuestros clientes y promoviendo la cultura y tradición de la pirotecnia mexicana.
                                Nos comprometemos a innovar constantemente, cuidar cada detalle y garantizar que cada presentación sea una experiencia única, mágica y segura para todos.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Efectos de sparkle -->
            <div class="sparkle-effect" id="sparkles"></div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>

    <script>
        // Crear partículas animadas
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const numberOfParticles = 40;

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Crear efectos de sparkle
        function createSparkles() {
            const sparklesContainer = document.getElementById('sparkles');
            const numberOfSparkles = 8;

            for (let i = 0; i < numberOfSparkles; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.innerHTML = '✨';
                sparkle.style.left = Math.random() * 100 + '%';
                sparkle.style.top = Math.random() * 100 + '%';
                sparkle.style.animationDelay = Math.random() * 3 + 's';
                sparklesContainer.appendChild(sparkle);
            }
        }

        // Observer para animaciones de entrada
        const observerOptions = {
            root: null,
            rootMargin: '-50px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // Crear mini explosión de partículas al entrar
                    if (entry.target.classList.contains('vm-card')) {
                        createMiniExplosion(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Crear mini explosión de partículas
        function createMiniExplosion(element) {
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            for (let i = 0; i < 6; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                particle.style.width = '4px';
                particle.style.height = '4px';
                particle.style.background = '#ffd700';
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '1000';
                
                const angle = (i / 6) * Math.PI * 2;
                const distance = 50 + Math.random() * 30;
                const endX = centerX + Math.cos(angle) * distance;
                const endY = centerY + Math.sin(angle) * distance;
                
                particle.animate([
                    { 
                        transform: 'translate(0, 0) scale(0)',
                        opacity: 1
                    },
                    { 
                        transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(1)`,
                        opacity: 0
                    }
                ], {
                    duration: 800,
                    easing: 'ease-out'
                }).onfinish = () => particle.remove();
                
                document.body.appendChild(particle);
            }
        }

        // Efecto parallax suave
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            const particles = document.getElementById('particles');
            if (particles) {
                particles.style.transform = `translateY(${rate}px)`;
            }

            // Efecto parallax en las imágenes
            const images = document.querySelectorAll('.historia-image, .vm-image');
            images.forEach(img => {
                const rect = img.getBoundingClientRect();
                const speed = 0.1;
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const yPos = -(scrolled * speed);
                    img.style.transform = `translateY(${yPos}px)`;
                }
            });
        });

        // Efecto hover mejorado para las cards
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            createSparkles();
            
            // Observar elementos para animaciones
            const elementsToObserve = document.querySelectorAll('.vm-card, .historia-content, .historia-image-container');
            elementsToObserve.forEach(el => observer.observe(el));

            // Agregar efectos hover mejorados
            const cards = document.querySelectorAll('.vm-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Crear efecto de brillo
                    const shimmer = document.createElement('div');
                    shimmer.style.position = 'absolute';
                    shimmer.style.top = '0';
                    shimmer.style.left = '-100%';
                    shimmer.style.width = '100%';
                    shimmer.style.height = '100%';
                    shimmer.style.background = 'linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent)';
                    shimmer.style.pointerEvents = 'none';
                    shimmer.style.transition = 'left 0.6s ease';
                    
                    this.style.position = 'relative';
                    this.appendChild(shimmer);
                    
                    setTimeout(() => {
                        shimmer.style.left = '100%';
                    }, 50);
                    
                    setTimeout(() => {
                        shimmer.remove();
                    }, 650);
                });
            });

            // Efecto de typing para el título principal
            const mainTitle = document.querySelector('.historia-title');
            if (mainTitle) {
                const text = mainTitle.textContent;
                mainTitle.textContent = '';
                let i = 0;
                
                const typeWriter = () => {
                    if (i < text.length) {
                        mainTitle.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 100);
                    }
                };
                
                // Iniciar el efecto después de que la animación de entrada termine
                setTimeout(typeWriter, 1000);
            }
        });

        // Crear partículas al hacer click
        document.addEventListener('click', function(e) {
            const colors = ['#ff6b35', '#f7931e', '#ffd700', '#4e7bff', '#35a545'];
            
            for (let i = 0; i < 5; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.left = e.clientX + 'px';
                particle.style.top = e.clientY + 'px';
                particle.style.width = '6px';
                particle.style.height = '6px';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '1000';
                
                const angle = Math.random() * Math.PI * 2;
                const distance = 50 + Math.random() * 50;
                const endX = e.clientX + Math.cos(angle) * distance;
                const endY = e.clientY + Math.sin(angle) * distance;
                
                particle.animate([
                    { 
                        transform: 'translate(0, 0) scale(1)',
                        opacity: 1
                    },
                    { 
                        transform: `translate(${endX - e.clientX}px, ${endY - e.clientY}px) scale(0)`,
                        opacity: 0
                    }
                ], {
                    duration: 1000,
                    easing: 'ease-out'
                }).onfinish = () => particle.remove();
                
                document.body.appendChild(particle);
            }
        });
    </script>
</body>

</html>
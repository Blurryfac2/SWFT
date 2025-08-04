<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Pirotecnia FR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/contact.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Partículas animadas de fondo -->
    <div class="particles" id="particles"></div>

    <div class="page-wrapper">
        @include('components.header')
        
        <main>
            <!-- Hero Section -->
            <div class="contact-hero">
            <br>
                <h1>CONTÁCTANOS</h1>
                <p>Hagamos realidad tus sueños pirotécnicos</p>
            </div>

            <div id="contacto">
                <!-- Tarjeta de Información -->
                <div class="tarjeta">
                    <img src="{{ asset('img/logo.png') }}" alt="logo">

                    <div class="info">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <h3>DIRECCIÓN:</h3>
                            <p>La Blanca Centro Nº13,</p>
                            <p>C.P. 42621 Santiago de Anaya, Hgo.</p>
                        </div>
                    </div>

                    {{-- Mapa de Google Maps con dirección correcta y responsivo --}}
                    <div class="mapa-contacto">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29924.37562437045!2d-99.04991724438145!3d20.36032639004194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d165d6145d9b31%3A0x4baec1478c086c37!2spirotecnia%20FR!5e0!3m2!1ses-419!2smx!4v1752469969587!5m2!1ses-419!2smx"
                            width="100%"
                            height="220"
                            style="border:0; border-radius:10px;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="info">
                        <i class="fa-solid fa-phone-volume"></i>
                        <div>
                            <h3>TELÉFONOS:</h3>
                            <h4>TELÉFONO OFICINA:</h4>
                            <p>772 129 0122</p>
                            <h4>TELEFONO CELULAR:</h4>
                            <p>772 111 5821</p>
                        </div>
                    </div>

                    <div class="info">
                        <i class="fa-solid fa-clock"></i>
                        <div>
                            <h3>HORARIO ATENCIÓN</h3>
                            <p>7:00 AM – 8:00 PM</p>
                        </div>
                    </div>

                    <div class="info">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <h3>CORREO ELECTRÓNICO</h3>
                            <p>pirotecnia.fr@gmail.com</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Contacto -->
                <form class="tarjeta" method="POST" action="{{ route('contacto.enviar') }}">
                    @csrf
                    <h2>DATOS DE CONTACTO</h2>

                    @if(session('success'))
                    <div class="mensaje success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                    <div class="mensaje error">{{ $errors->first() }}</div>
                    @endif

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>

                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingrese su correo electrónico" required>

                    <label for="asunto">Asunto</label>
                    <input type="text" name="asunto" id="asunto" placeholder="Ingrese su asunto" required>

                    <label for="celular">Número telefónico</label>
                    <input type="tel" name="celular" id="celular" placeholder="Ingrese su número telefónico" pattern="[0-9]{10}" maxlength="10" required>

                    <label for="mensaje">Mensaje</label>
                    <textarea name="mensaje" id="mensaje" placeholder="Descríbanos el motivo de contacto" required></textarea>

                    <div class="recaptcha-wrapper">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    </div>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="mensaje error">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif

                    <button type="submit" class="btn-enviar">
                        <i class="fa-solid fa-paper-plane fly"></i> Enviar Mensaje
                    </button>
                </form>
            </div>

            <!-- Efectos de sparkle -->
            <div class="sparkle-effect" id="sparkles"></div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // Crear partículas animadas
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const numberOfParticles = 35;

            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.animationDuration = (Math.random() * 5 + 8) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Crear efectos de sparkle
        function createSparkles() {
            const sparklesContainer = document.getElementById('sparkles');
            const numberOfSparkles = 12;

            for (let i = 0; i < numberOfSparkles; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.innerHTML = '✨';
                sparkle.style.left = Math.random() * 100 + '%';
                sparkle.style.top = Math.random() * 100 + '%';
                sparkle.style.animationDelay = Math.random() * 4 + 's';
                sparklesContainer.appendChild(sparkle);
            }
        }

        // Validación en tiempo real
        function setupFormValidation() {
            const inputs = document.querySelectorAll('input, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.checkValidity()) {
                        this.style.borderColor = '#35a545';
                        this.style.boxShadow = '0 0 15px rgba(53, 165, 69, 0.3)';
                    } else {
                        this.style.borderColor = '#f44336';
                        this.style.boxShadow = '0 0 15px rgba(244, 67, 54, 0.3)';
                    }
                });

                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                        this.style.boxShadow = 'none';
                    }
                });
            });
        }

        // Efecto de escritura en el formulario
        function typeWriterEffect() {
            const title = document.querySelector('.tarjeta h2');
            if (title) {
                const text = title.textContent;
                title.textContent = '';
                let i = 0;
                
                const type = () => {
                    if (i < text.length) {
                        title.textContent += text.charAt(i);
                        i++;
                        setTimeout(type, 100);
                    }
                };
                
                setTimeout(type, 1000);
            }
        }

        // Animación de explosión al enviar formulario
        function createFormExplosion(button) {
            const rect = button.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const colors = ['#ff6b35', '#f7931e', '#ffd700', '#4e7bff'];

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                particle.style.width = '6px';
                particle.style.height = '6px';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '1000';
                
                const angle = (i / 15) * Math.PI * 2;
                const distance = 80 + Math.random() * 40;
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
                    duration: 1200,
                    easing: 'ease-out'
                }).onfinish = () => particle.remove();
                
                document.body.appendChild(particle);
            }
        }

        // Efecto parallax
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.3;
            
            const particles = document.getElementById('particles');
            if (particles) {
                particles.style.transform = `translateY(${rate}px)`;
            }
        });

        // Efecto hover mejorado para las tarjetas
        function setupCardEffects() {
            const cards = document.querySelectorAll('.tarjeta');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Crear ondas de luz
                    const wave = document.createElement('div');
                    wave.style.position = 'absolute';
                    wave.style.top = '50%';
                    wave.style.left = '50%';
                    wave.style.width = '0';
                    wave.style.height = '0';
                    wave.style.background = 'radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 70%)';
                    wave.style.borderRadius = '50%';
                    wave.style.transform = 'translate(-50%, -50%)';
                    wave.style.pointerEvents = 'none';
                    wave.style.zIndex = '1';
                    
                    this.appendChild(wave);
                    
                    wave.animate([
                        { width: '0', height: '0', opacity: 1 },
                        { width: '400px', height: '400px', opacity: 0 }
                    ], {
                        duration: 800,
                        easing: 'ease-out'
                    }).onfinish = () => wave.remove();
                });
            });
        }

        // Efecto de focus mejorado para inputs
        function setupInputEffects() {
            const inputs = document.querySelectorAll('input, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const label = this.previousElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        label.style.color = '#ff6b35';
                        label.style.transform = 'translateY(-2px)';
                        label.style.textShadow = '0 0 10px rgba(255, 107, 53, 0.5)';
                    }
                });

                input.addEventListener('blur', function() {
                    const label = this.previousElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        label.style.color = '#ffd700';
                        label.style.transform = 'translateY(0)';
                        label.style.textShadow = 'none';
                    }
                });
            });
        }

        // Animación de contador para números de teléfono
        function animatePhoneNumbers() {
            const phoneElements = document.querySelectorAll('.info p');
            
            phoneElements.forEach(element => {
                if (/^\d{3}\s\d{3}\s\d{4}$/.test(element.textContent)) {
                    const originalText = element.textContent;
                    element.textContent = '';
                    
                    let i = 0;
                    const typeNumber = () => {
                        if (i < originalText.length) {
                            element.textContent += originalText.charAt(i);
                            i++;
                            setTimeout(typeNumber, 100);
                        }
                    };
                    
                    // Observar cuando el elemento entre en vista
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                setTimeout(typeNumber, Math.random() * 1000);
                                observer.disconnect();
                            }
                        });
                    });
                    
                    observer.observe(element);
                }
            });
        }

        // Efecto de click en el mapa
        function setupMapEffect() {
            const mapContainer = document.querySelector('.mapa-contacto');
            if (mapContainer) {
                mapContainer.addEventListener('click', function(e) {
                    const colors = ['#ff6b35', '#ffd700', '#f7931e'];
                    
                    for (let i = 0; i < 8; i++) {
                        const ripple = document.createElement('div');
                        ripple.style.position = 'absolute';
                        ripple.style.left = e.offsetX + 'px';
                        ripple.style.top = e.offsetY + 'px';
                        ripple.style.width = '10px';
                        ripple.style.height = '10px';
                        ripple.style.background = colors[Math.floor(Math.random() * colors.length)];
                        ripple.style.borderRadius = '50%';
                        ripple.style.pointerEvents = 'none';
                        ripple.style.zIndex = '10';
                        
                        this.appendChild(ripple);
                        
                        const angle = (i / 8) * Math.PI * 2;
                        const distance = 30 + Math.random() * 20;
                        const endX = e.offsetX + Math.cos(angle) * distance;
                        const endY = e.offsetY + Math.sin(angle) * distance;
                        
                        ripple.animate([
                            { 
                                transform: 'translate(-50%, -50%) scale(0)',
                                opacity: 1
                            },
                            { 
                                transform: `translate(${endX - e.offsetX - 5}px, ${endY - e.offsetY - 5}px) scale(1.5)`,
                                opacity: 0
                            }
                        ], {
                            duration: 600,
                            easing: 'ease-out'
                        }).onfinish = () => ripple.remove();
                    }
                });
            }
        }

        // Inicialización cuando la página carga
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            createSparkles();
            setupFormValidation();
            typeWriterEffect();
            setupCardEffects();
            setupInputEffects();
            animatePhoneNumbers();
            setupMapEffect();

            // Efecto de envío del formulario
            const form = document.querySelector('form');
            const submitButton = document.querySelector('.btn-enviar');
            
            if (form && submitButton) {
                form.addEventListener('submit', function(e) {
                    createFormExplosion(submitButton);
                    
                    // Cambiar texto del botón temporalmente
                    const originalText = submitButton.innerHTML;
                    submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';
                    submitButton.disabled = true;
                    
                    // Si hay errores, restaurar el botón después de un momento
                    setTimeout(() => {
                        if (!form.checkValidity()) {
                            submitButton.innerHTML = originalText;
                            submitButton.disabled = false;
                        }
                    }, 2000);
                });
            }

            // Animación de entrada de las secciones de información
            const infoSections = document.querySelectorAll('.info');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateX(0)';
                        }, index * 200);
                    }
                });
            }, { threshold: 0.1 });

            infoSections.forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateX(-30px)';
                section.style.transition = 'all 0.6s ease';
                observer.observe(section);
            });
        });


        document.addEventListener('keydown', function(e) {
            if (e.target.matches('input, textarea')) {
                
                const rect = e.target.getBoundingClientRect();
                const x = rect.left + Math.random() * rect.width;
                const y = rect.top + Math.random() * 20;
                
                const sparkle = document.createElement('div');
                sparkle.innerHTML = '✨';
                sparkle.style.position = 'fixed';
                sparkle.style.left = x + 'px';
                sparkle.style.top = y + 'px';
                sparkle.style.pointerEvents = 'none';
                sparkle.style.zIndex = '1000';
                sparkle.style.fontSize = '0.8rem';
                
                document.body.appendChild(sparkle);
                
                sparkle.animate([
                    { 
                        opacity: 1,
                        transform: 'translateY(0) scale(0.5)'
                    },
                    { 
                        opacity: 0,
                        transform: 'translateY(-30px) scale(1)'
                    }
                ], {
                    duration: 800,
                    easing: 'ease-out'
                }).onfinish = () => sparkle.remove();
            }
        });
    </script>
</body>

</html>
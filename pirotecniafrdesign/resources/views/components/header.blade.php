<header>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;600;700&display=swap');
    
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      transition: all 0.3s ease;
      backdrop-filter: blur(20px);
    }

    
    header.scrolled {
      background: rgba(0, 0, 0, 0.95);
      box-shadow: 0 5px 30px rgba(255, 107, 53, 0.3);
    }
    
    .top-bar {
      height: 60px;
      background: linear-gradient(135deg, #ff6b35 0%, #f7931e 25%, #ffd700 50%, #f7931e 75%, #ff6b35 100%);
      background-size: 300% 300%;
      animation: gradientFlow 6s ease-in-out infinite;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
      position: relative;
      overflow: hidden;
    }


    @keyframes gradientFlow {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }


    .top-bar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
      animation: sparkleMove 8s ease-in-out infinite;
      pointer-events: none;
    }

    @keyframes sparkleMove {
      0%, 100% { opacity: 0.3; }
      50% { opacity: 0.7; }
    }
    
    .logo-img {
      height: 60px;
      width: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid rgba(255, 255, 255, 0.3);
      box-shadow: 
        0 0 20px rgba(255, 215, 0, 0.5),
        inset 0 0 20px rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
      position: relative;
      z-index: 2;
    }

    .logo-img:hover {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 
        0 0 30px rgba(255, 215, 0, 0.8),
        inset 0 0 30px rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 215, 0, 0.8);
    }
    
    .brand-title {
      color: white;
      font-family: 'Orbitron', monospace;
      font-size: 2.2rem;
      font-weight: 900;
      text-align: center;
      flex-grow: 1;
      text-shadow: 
        0 0 10px rgba(255, 255, 255, 0.5),
        0 0 20px rgba(255, 215, 0, 0.3),
        0 0 30px rgba(255, 107, 53, 0.2);
      letter-spacing: 0.1em;
      position: relative;
      z-index: 2;
      animation: titleGlow 3s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
      0% {
        text-shadow: 
          0 0 10px rgba(255, 255, 255, 0.5),
          0 0 20px rgba(255, 215, 0, 0.3),
          0 0 30px rgba(255, 107, 53, 0.2);
      }
      100% {
        text-shadow: 
          0 0 15px rgba(255, 255, 255, 0.8),
          0 0 25px rgba(255, 215, 0, 0.6),
          0 0 35px rgba(255, 107, 53, 0.4);
      }
    }
    
    .top-bar .left-logo,
    .top-bar .right-logo {
      width: 60px;
      position: relative;
      z-index: 2;
    }
    
    .nav-bar {
      background: rgba(0, 0, 0, 0.9);
      backdrop-filter: blur(15px);
      border-top: 2px solid rgba(255, 215, 0, 0.3);
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .nav-bar::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, 
        transparent, 
        #ffd700, 
        #ff6b35, 
        #ffd700, 
        transparent
      );
      animation: lineMove 3s ease-in-out infinite;
    }

    @keyframes lineMove {
      0% { left: -100%; }
      100% { left: 100%; }
    }
    
    nav {
      display: flex;
      gap: 1rem;
      padding: 1rem 0;
      position: relative;
      z-index: 2;
    }
    
    nav a {
      color: white;
      text-decoration: none;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      position: relative;
      padding: 0.5rem 1rem;
      border-radius: 25px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    
    nav a::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, #ff6b35, #ffd700);
      border-radius: 25px;
      opacity: 0;
      transform: scale(0.8);
      transition: all 0.3s ease;
      z-index: -1;
    }

    nav a:hover::before {
      opacity: 1;
      transform: scale(1);
    }
    
    nav a:hover {
      color: #000;
      font-weight: 700;
      text-shadow: none;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }


    nav a::after {
      content: '✨';
      position: absolute;
      top: -10px;
      right: -10px;
      opacity: 0;
      transform: scale(0);
      transition: all 0.3s ease;
    }

    nav a:hover::after {
      opacity: 1;
      transform: scale(1);
      animation: sparkleRotate 0.6s ease-in-out;
    }

    @keyframes sparkleRotate {
      0%, 100% { transform: scale(1) rotate(0deg); }
      50% { transform: scale(1.2) rotate(180deg); }
    }
    
    .menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
      position: relative;
      z-index: 3;
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .menu-toggle:hover {
      background: rgba(255, 215, 0, 0.2);
      transform: scale(1.1);
    }
    
    .menu-toggle span {
      background: white;
      height: 3px;
      width: 30px;
      margin: 4px 0;
      border-radius: 3px;
      transition: all 0.3s ease;
      box-shadow: 0 0 5px rgba(255, 215, 0, 0.3);
    }

    .menu-toggle.active span:nth-child(1) {
      transform: rotate(45deg) translate(7px, 7px);
      background: #ffd700;
    }

    .menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
      transform: rotate(-45deg) translate(7px, -7px);
      background: #ffd700;
    }
    
    @media (max-width: 768px) {
      .top-bar {
        justify-content: space-between;
        padding: 0 1rem;
        height: 70px;
      }
      
      .right-logo {
        display: none;
      }
      
      .brand-title {
        font-size: 1.6rem;
      }
      
      .nav-bar {
        flex-direction: column;
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s ease;
      }

      .nav-bar.show {
        max-height: 300px;
        padding: 1rem 0;
      }
      
      nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        gap: 1rem;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s ease;
      }
      
      nav.show {
        opacity: 1;
        transform: translateY(0);
      }

      nav a {
        font-size: 1rem;
        padding: 0.8rem 2rem;
        width: 200px;
        text-align: center;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 215, 0, 0.3);
        margin: 0.2rem 0;
      }

      nav a:hover {
        background: linear-gradient(45deg, #ff6b35, #ffd700);
        border-color: #ffd700;
        transform: scale(1.05);
      }
      
      .menu-toggle {
        display: flex;
        position: absolute;
        top: 20px;
        right: 1rem;
      }
    }

    @media (max-width: 480px) {
      .brand-title {
        font-size: 1.3rem;
      }

      .logo-img {
        height: 50px;
        width: 50px;
      }

      nav a {
        width: 180px;
        font-size: 0.9rem;
      }
    }

    /* Animación de entrada al cargar la página */
    header {
      animation: slideDown 0.8s ease-out;
    }

    @keyframes slideDown {
      0% {
        transform: translateY(-100%);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
  
  <div class="top-bar">
    <div class="left-logo">
      <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="logo-img" />
    </div>
    <div class="brand-title">PIROTECNIA "FR"</div>
    <div class="right-logo">
      <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="logo-img" />
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  
  <div class="nav-bar">
    <nav>
      <a href="/">Inicio</a>
      <a href="/productos">Productos</a>
      <a href="/historia">Historia</a>
      <a href="/contacto">Contacto</a>
      <a href="{{ route('login') }}">Iniciar sesión</a>
    </nav>
  </div>
  
  <script>
    // Función mejorada para toggle del menú
    function toggleMenu() {
      const nav = document.querySelector('nav');
      const navBar = document.querySelector('.nav-bar');
      const menuToggle = document.querySelector('.menu-toggle');
      
      nav.classList.toggle('show');
      navBar.classList.toggle('show');
      menuToggle.classList.toggle('active');
    }

    // Cerrar menú al hacer click en los enlaces
    document.querySelectorAll('nav a').forEach(link => {
      link.addEventListener('click', () => {
        const nav = document.querySelector('nav');
        const navBar = document.querySelector('.nav-bar');
        const menuToggle = document.querySelector('.menu-toggle');
        
        nav.classList.remove('show');
        navBar.classList.remove('show');
        menuToggle.classList.remove('active');
      });
    });

    // Efecto al hacer scroll - header se vuelve más transparente
    window.addEventListener('scroll', () => {
      const header = document.querySelector('header');
      const scrollY = window.scrollY;
      
      if (scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Cerrar menú móvil al hacer click fuera
    document.addEventListener('click', (e) => {
      const nav = document.querySelector('nav');
      const navBar = document.querySelector('.nav-bar');
      const menuToggle = document.querySelector('.menu-toggle');
      const header = document.querySelector('header');
      
      if (!header.contains(e.target) && nav.classList.contains('show')) {
        nav.classList.remove('show');
        navBar.classList.remove('show');
        menuToggle.classList.remove('active');
      }
    });

    // Efecto de resize para cerrar menú móvil
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768) {
        const nav = document.querySelector('nav');
        const navBar = document.querySelector('.nav-bar');
        const menuToggle = document.querySelector('.menu-toggle');
        
        nav.classList.remove('show');
        navBar.classList.remove('show');
        menuToggle.classList.remove('active');
      }
    });
  </script>
</header>
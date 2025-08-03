<footer x-data="{ showAviso: false }" class="relative z-10">
  <style>
    [x-cloak] { display: none !important; }
    
    footer {
      position: relative;
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
      padding: 2rem 0;
      color: white;
      font-family: 'Inter', sans-serif;
      text-align: center;
      border-top: 1px solid rgba(255, 107, 53, 0.3);
      overflow: hidden;
    }

 
    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, 
        transparent, 
        #ff6b35, 
        #ffd700, 
        #ff6b35, 
        transparent
      );
      background-size: 200% 100%;
      animation: lineMove 3s linear infinite;
    }

    @keyframes lineMove {
      0% { background-position: -100% 0; }
      100% { background-position: 100% 0; }
    }

    .footer-content {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    .footer-copyright {
      font-size: 0.9rem;
    }

    .footer-copyright a {
      color: #ffd700;
      text-decoration: underline;
      transition: all 0.3s ease;
    }

    .footer-copyright a:hover {
      color: #ff6b35;
      text-shadow: 0 0 8px rgba(255, 107, 53, 0.5);
    }

    
    .aviso-modal {
      background: #fffaf0;
      color: #333;
      border: 2px solid #ff4500;
      box-shadow: 0 0 20px rgba(255, 69, 0, 0.5);
      width: 1000vw;
      max-width: 1000px;
      height: 50vh;
      max-height: 50vh;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 1.5rem 2rem;
      border-radius: 1rem;
      position: relative;
      text-align: left;
    }

    .aviso-modal h2 {
      color: #B22222;
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .aviso-modal a {
      color: #007BFF;
      text-decoration: underline;
    }

    .aviso-modal a:hover {
      color: #FF4500;
    }

    .aviso-modal p {
      margin-bottom: 0.5rem;
    }

    .aviso-modal .btn-cerrar {
      background-color: #b22222;
      border: none;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .aviso-modal .btn-cerrar:hover {
      background-color: #8b1a1a;
      transform: translateY(-2px);
    }

    .aviso-modal .close-btn {
      position: absolute;
      top: 0.5rem;
      right: 1rem;
      font-size: 1.25rem;
      color: #555;
      background: none;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .aviso-modal .close-btn:hover {
      color: #C70039;
      transform: rotate(90deg);
    }

    .fixed.inset-0 {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      background: rgba(0, 0, 0, 0.6);
      overflow-y: auto;
      z-index: 9999;
    }

    footer::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 30%, rgba(255, 107, 53, 0.05) 0%, transparent 20%),
        radial-gradient(circle at 80% 70%, rgba(255, 215, 0, 0.05) 0%, transparent 20%);
      pointer-events: none;
    }

    footer {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @media (max-width: 640px) {
      .aviso-modal {
        font-size: 0.85rem;
        max-height: 90vh;
        padding: 1.2rem;
      }
      
      .aviso-modal h2 {
        font-size: 1.3rem;
      }
    }
  </style>

  <div class="footer-content">
    <div class="footer-copyright">
      Derechos reservados © 2025 Pirotecnia FR |
      <a href="#" @click.prevent="showAviso = true" class="underline hover:text-yellow-300">Aviso de Privacidad</a>
    </div>
  </div>


  <div x-show="showAviso" x-cloak class="fixed inset-0 z-[9999] p-4 flex items-center justify-center">
    <div class="aviso-modal">
      <button @click="showAviso = false" class="close-btn" aria-label="Cerrar aviso">✕</button>

      <h2>Aviso de Privacidad</h2>

      <div class="text-sm space-y-3">
        <p><strong>Resumen del Aviso de Privacidad:</strong></p>
        <p>FR Pirotecnia es responsable del tratamiento de sus datos personales.</p>
        <p>Utilizaremos su información para fines relacionados con atención al cliente, contacto, cotización de servicios y mejora de nuestra plataforma.</p>
        <p>Usted puede ejercer sus derechos ARCO (Acceso, Rectificación, Cancelación u Oposición) a través de nuestros medios de contacto.</p>
        <p>Para más información, consulte nuestro aviso completo en el enlace.</p>

        <div class="mt-3">
          <label class="inline-flex items-start">
            <input type="checkbox" class="mr-2 mt-1">
            <span>He leído y acepto el Aviso de Privacidad Integral de FR Pirotecnia.</span>
          </label>
        </div>

        <p class="mt-2">
          <a href="{{ route('politics') }}" target="_blank">Leer términos completos del aviso de privacidad</a>
        </p>
      </div>

      <div class="mt-5 text-end">
        <button @click="showAviso = false" class="btn-cerrar">Cerrar</button>
      </div>
    </div>
  </div>
</footer>
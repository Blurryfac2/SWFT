<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra Historia</title>
    @vite(['resources/css/politics.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">
    <div class="page-wrapper">
        @include('components.header')

        <main class="px-4 py-10 bg-purple-950 pt-32">
            <div class="aviso-container text-white max-w-4xl mx-auto space-y-6">
                <h1 class="text-3xl font-bold">Aviso de Privacidad Integral – FR Pirotecnia</h1>

                <p><strong>Responsable del tratamiento:</strong> FR Pirotecnia</p>
                <p><strong>Correo electrónico:</strong> <a href="mailto:pirotecnia.fr@gmail.com" class="underline">pirotecnia.fr@gmail.com</a></p>
                <p><strong>Teléfono Oficina:</strong> 772 129 0122</p>
                <p><strong>Teléfono Celular:</strong> 772 111 5821</p>

                <h2 class="text-2xl font-semibold mt-6">Finalidades del tratamiento:</h2>
                <ul class="list-disc pl-6">
                    <li><strong>Primarias:</strong> Proveer servicios, responder solicitudes, cotizaciones, contactar al usuario, cumplir con obligaciones legales.</li>
                    <li><strong>Secundarias:</strong> Enviar promociones, realizar análisis de uso del sitio y mejorar la experiencia del usuario.</li>
                </ul>

                <h2 class="text-2xl font-semibold mt-6">Datos personales recabados:</h2>
                <ul class="list-disc pl-6">
                    <li>Nombre completo</li>
                    <li>Correo electrónico</li>
                    <li>Teléfono</li>
                    <li>Dirección</li>
                    <li>Datos de facturación (si aplica)</li>
                    <li>Ubicación</li>
                </ul>

                <h2 class="text-2xl font-semibold mt-6">Derechos ARCO:</h2>
                <p>
                    Usted puede solicitar el acceso, rectificación, cancelación u oposición al uso de sus datos enviando un correo a:
                    <a href="mailto:pirotecnia.fr@gmail.com" class="underline">pirotecnia.fr@gmail.com</a>.
                    Responderemos en un plazo no mayor a 20 días hábiles.
                </p>
            </div>
        </main>

        @include('components.footer')
        @include('components.floating-buttons')
    </div>
</body>

</html>

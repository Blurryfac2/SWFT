@extends('layouts.admin')

@section('title', 'Contactos')

@section('header')
<h2 class="font-semibold text-xl text-yellow-400 leading-tight">
    {{ __('Mensajes de contacto') }}
</h2>
@endsection

@section('content')
<div class="contactos-wrapper py-6 px-4 bg-black min-h-screen">
    @if(session('success'))
    <div class="mensaje-success bg-green-900 border border-green-500 text-green-300 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid-contactos">
        @foreach ($contactos as $contacto)
        <div class="card-contacto bg-gray-900 border border-gray-700 hover:bg-gray-800 transition-colors">
            <div class="asunto text-yellow-400 font-bold">{{ $contacto->asunto }}</div>
            <div class="info text-gray-300"><strong class="text-yellow-400">De:</strong> {{ $contacto->nombre }}</div>
            <div class="info text-gray-300">
                <strong class="text-yellow-400">Correo:</strong>
                <a href="mailto:{{ $contacto->correo }}" class="text-yellow-300 hover:underline">{{ $contacto->correo }}</a>
            </div>
            <div class="info text-gray-300"><strong class="text-yellow-400">Celular:</strong> {{ $contacto->celular }}</div>
            <div class="mensaje text-gray-200 mt-2">{{ $contacto->mensaje }}</div>
            <div class="fecha text-gray-500 text-sm mt-3">Enviado el {{ $contacto->created_at->format('d/m/Y H:i') }}</div>
            <a href="#"
                onclick="abrirGmail('{{ $contacto->correo }}', '{{ urlencode($contacto->asunto) }}')"
                class="btn-responder mt-4 bg-yellow-500 hover:bg-yellow-600 text-black font-medium">
                Responder
            </a>
        </div>
        @endforeach
    </div>

    <div class="paginacion mt-6">
        {!! $contactos->links() !!}
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    .contactos-wrapper {
        max-width: 1280px;
        margin: 0 auto;
    }

    .grid-contactos {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .grid-contactos {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid-contactos {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .card-contacto {
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .asunto {
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .info {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        word-break: break-word;
    }

    .mensaje {
        font-size: 0.95rem;
        white-space: pre-line;
        line-height: 1.5;
    }

    .fecha {
        margin-top: 1rem;
    }

    .btn-responder {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination {
        display: flex;
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background-color: #f59e0b;
        border-color: #f59e0b;
        color: #000;
    }

    .pagination .page-link {
        color: #f59e0b;
        background-color: #1f2937;
        border: 1px solid #374151;
    }

    .pagination .page-link:hover {
        background-color: #374151;
        color: #fbbf24;
    }
</style>
@endsection

<script>
    function abrirGmail(correo, asunto) {
        const url = `https://mail.google.com/mail/?view=cm&fs=1&to=${correo}&su=Re:%20${asunto}`;
        const width = 1000;
        const height = 700;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        window.open(
            url,
            'ResponderGmail',
            `width=${width},height=${height},top=${top},left=${left},toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes`
        );
    }
</script>
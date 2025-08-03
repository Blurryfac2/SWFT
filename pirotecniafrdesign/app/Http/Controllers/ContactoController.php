<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::latest()->simplePaginate(12);
        return view('emails.index', compact('contactos'));
    }
    public function enviar(Request $request)
    {
        $validated = $request->validate([
            'nombre'   => 'required|string|max:100',
            'correo'   => 'required|email',
            'asunto'   => 'required|string|max:100',
            'celular'  => 'required|digits:10',
            'mensaje'  => 'required|string',
            'g-recaptcha-response' => 'required'
        ]);

        $contacto = Contacto::create($validated);

        Mail::to(env('CONTACTO_DESTINO'))->send(new \App\Mail\ContactoRecibido($contacto));

        return redirect('/contacto')->with('success', 'Mensaje enviado correctamente.');
    }
}

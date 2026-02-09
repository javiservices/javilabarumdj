<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use App\Mail\ContactConfirmation;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // 1. Enviar email al admin (booking@javilabarumdj.com)
            Mail::to(config('mail.from.address'))
                ->send(new ContactMessage($validated));

            // 2. Enviar email de confirmación al usuario
            Mail::to($validated['email'])
                ->send(new ContactConfirmation($validated));

            // Guardar en logs para backup
            \Log::info('Nuevo mensaje de contacto', $validated);

            return redirect()->route('contact.show')->with('success', 'mensaje_enviado');
        } catch (\Exception $e) {
            \Log::error('Error al enviar mensaje de contacto: ' . $e->getMessage());
            return back()->with('error', 'Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.')->withInput();
        }
    }
}

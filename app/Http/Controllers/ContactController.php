<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $recipientEmail = 'creatifbimbim@gmail.com';

        try {
            Mail::send('emails.contact', [
                'senderName' => $validated['name'],
                'senderEmail' => $validated['email'],
                'senderMessage' => $validated['message'],
                'date' => now()->format('d M Y, H:i T'),
            ], function ($message) use ($validated, $recipientEmail) {
                $message->to($recipientEmail)
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('New Portfolio Message from '.$validated['name']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim ke '.$recipientEmail.'! Silakan cek kotak masuk / inbox Gmail Anda.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email otomatis. Pastikan konfigurasi SMTP Gmail sudah diatur pada file .env (MAIL_USERNAME & MAIL_PASSWORD). Error: '.$e->getMessage(),
                'fallback_url' => 'mailto:'.$recipientEmail.'?subject='.rawurlencode('Portfolio Message from '.$validated['name']).'&body='.rawurlencode("Halo Bimo,\n\nNama: ".$validated['name']."\nEmail: ".$validated['email']."\n\nPesan:\n".$validated['message']),
            ], 500);
        }
    }
}

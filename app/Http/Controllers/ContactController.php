<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSubmissionRequest;
use App\Mail\ContactSubmissionMail;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class ContactController extends Controller
{
    public function store(ContactSubmissionRequest $request, string $locale): RedirectResponse
    {
        $payload = $request->validated();

        ContactSubmission::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'subject' => $payload['subject'],
            'message' => $payload['message'],
            'locale' => $locale,
            'source' => $payload['source'],
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        try {
            Mail::to(config('mail.contact_to.address', 'admin@elditech.com'))
                ->send(new ContactSubmissionMail([
                    ...$payload,
                    'locale' => $locale,
                ]));
        } catch (Throwable $exception) {
            report($exception);

            throw ValidationException::withMessages([
                'mail' => [
                    $locale === 'id'
                        ? 'Pesan gagal dikirim. Silakan coba beberapa saat lagi.'
                        : 'Your message could not be sent right now. Please try again shortly.',
                ],
            ]);
        }

        return back()->with(
            'success',
            $locale === 'id'
                ? 'Pesan berhasil dikirim ke tim kami.'
                : 'Your message has been sent to our team.'
        );
    }
}

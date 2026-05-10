<?php

namespace Tests\Feature;

use App\Mail\ContactSubmissionMail;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_submission_sends_mail_and_persists_data(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        Mail::fake();

        $response = $this->post('/en/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'General Inquiry',
            'message' => 'Testing end to end contact flow.',
            'source' => 'contact',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'General Inquiry',
            'source' => 'contact',
            'locale' => 'en',
        ]);

        Mail::assertSent(ContactSubmissionMail::class, function (ContactSubmissionMail $mail): bool {
            return $mail->payload['email'] === 'jane@example.com'
                && $mail->payload['source'] === 'contact';
        });
    }
}

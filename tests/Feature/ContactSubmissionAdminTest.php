<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactSubmissionAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_submissions_index_requires_authentication(): void
    {
        $response = $this->get(route('contact-submissions.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_verified_admin_can_view_contact_submissions_index(): void
    {
        $user = User::factory()->create();

        ContactSubmission::query()->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'subject' => 'Need mobile app support',
            'message' => 'Please contact me soon.',
            'locale' => 'en',
            'source' => 'contact',
        ]);

        $response = $this->actingAs($user)->get(route('contact-submissions.index'));

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page
            ->component('ContactSubmissions/Index')
            ->where('stats.total', 1)
            ->where('stats.unread', 1)
        );
    }

    public function test_admin_can_mark_submission_as_read(): void
    {
        $user = User::factory()->create();

        $submission = ContactSubmission::query()->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'subject' => 'Project inquiry',
            'message' => 'Do you build Laravel apps?',
            'locale' => 'en',
            'source' => 'home',
        ]);

        $response = $this->actingAs($user)->patch(route('contact-submissions.read', $submission), [
            'is_read' => true,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'id' => $submission->id,
            'is_read' => 1,
        ]);
    }

    public function test_admin_can_bulk_delete_submissions(): void
    {
        $user = User::factory()->create();

        $one = ContactSubmission::query()->create([
            'name' => 'Charlie',
            'email' => 'charlie@example.com',
            'subject' => 'One',
            'message' => 'First message',
            'locale' => 'en',
            'source' => 'contact',
        ]);

        $two = ContactSubmission::query()->create([
            'name' => 'Diana',
            'email' => 'diana@example.com',
            'subject' => 'Two',
            'message' => 'Second message',
            'locale' => 'id',
            'source' => 'home',
        ]);

        $response = $this->actingAs($user)->delete(route('contact-submissions.bulk-destroy'), [
            'ids' => [$one->id, $two->id],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('contact_submissions', ['id' => $one->id]);
        $this->assertDatabaseMissing('contact_submissions', ['id' => $two->id]);
    }

    public function test_admin_can_export_csv(): void
    {
        $user = User::factory()->create();

        ContactSubmission::query()->create([
            'name' => 'Export User',
            'email' => 'export@example.com',
            'subject' => 'Export me',
            'message' => 'CSV export verification',
            'locale' => 'en',
            'source' => 'contact',
        ]);

        $response = $this->actingAs($user)->get(route('contact-submissions.export'));

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}

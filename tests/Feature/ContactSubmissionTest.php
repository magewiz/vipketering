<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_submit_the_contact_form(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Ана Петровска',
            'phone' => '070 123 456',
            'email' => 'ana@example.com',
            'event_type' => 'Свадба',
            'event_date' => '2026-09-12',
            'guests' => 120,
            'message' => 'Раскажуваме за настанот.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'Ана Петровска',
            'phone' => '070 123 456',
            'event_type' => 'Свадба',
            'guests' => 120,
            'is_read' => false,
        ]);
    }

    public function test_filled_honeypot_is_silently_dropped(): void
    {
        // A bot fills the hidden "website" field; the request looks accepted but nothing is stored.
        $response = $this->post('/contact', [
            'name' => 'Спам Бот',
            'phone' => '000',
            'event_type' => 'Свадба',
            'website' => 'http://spam.example',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_contact_form_requires_name_phone_and_event_type(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'phone', 'event_type']);
        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_admin_can_list_submissions(): void
    {
        $user = User::factory()->create();
        ContactSubmission::create([
            'name' => 'Марко',
            'phone' => '071 000 111',
            'event_type' => 'Корпоративен',
        ]);

        $response = $this->actingAs($user)->get('/admin/contacts');

        $response->assertOk();
    }

    public function test_admin_can_mark_submission_read_and_delete_it(): void
    {
        $user = User::factory()->create();
        $submission = ContactSubmission::create([
            'name' => 'Марко',
            'phone' => '071 000 111',
            'event_type' => 'Корпоративен',
        ]);

        $this->actingAs($user)->patch("/admin/contacts/{$submission->id}", ['is_read' => true]);
        $this->assertDatabaseHas('contact_submissions', ['id' => $submission->id, 'is_read' => true]);

        $this->actingAs($user)->delete("/admin/contacts/{$submission->id}");
        $this->assertDatabaseMissing('contact_submissions', ['id' => $submission->id]);
    }

    public function test_guests_cannot_view_submissions(): void
    {
        $this->get('/admin/contacts')->assertRedirect('/admin/login');
    }

    public function test_admin_can_log_in_with_username_or_email(): void
    {
        User::factory()->create([
            'name' => 'an',
            'email' => 'an@vipketering.mk',
            'password' => Hash::make('123qwe!@#'),
        ]);

        // by username
        $this->post('/admin/login', ['login' => 'an', 'password' => '123qwe!@#'])
            ->assertRedirect('/admin');
        $this->post('/admin/logout');

        // by email
        $this->post('/admin/login', ['login' => 'an@vipketering.mk', 'password' => '123qwe!@#'])
            ->assertRedirect('/admin');
    }
}

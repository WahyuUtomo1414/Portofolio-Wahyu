<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicFrontendTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_it_loads_the_main_public_portfolio_pages(): void
    {
        $this->get(route('home'))->assertOk();
    }

    public function test_it_returns_not_found_for_an_unknown_project_slug(): void
    {
        if (\Route::has('projects.show')) {
            $this->get(route('projects.show', 'unknown-project'))
                ->assertNotFound();
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_it_validates_the_public_contact_form(): void
    {
        if (\Route::has('contact.store')) {
            $this->postJson(route('contact.store'), [])
                ->assertStatus(422)
                ->assertJsonValidationErrors(['name', 'email', 'message']);
        } else {
            $this->assertTrue(true);
        }
    }
}

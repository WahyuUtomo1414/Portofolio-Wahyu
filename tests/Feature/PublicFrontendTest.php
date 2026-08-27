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
        $this->get(route('projects.index'))->assertOk();
        $this->get(route('projects.show', 'keysoft-erp-enterprise-system'))->assertOk();
        $this->get(route('blog.index'))->assertOk();
        $this->get(route('contact.index'))->assertOk();
    }

    public function test_it_returns_not_found_for_an_unknown_project_slug(): void
    {
        $this->get(route('projects.show', 'unknown-project'))
            ->assertNotFound();
    }

    public function test_it_validates_the_public_contact_form(): void
    {
        $this->post(route('contact.store'), [])
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }
}

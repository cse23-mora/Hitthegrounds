<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_register_page_can_be_rendered(): void
    {
        $response = $this->get(route('admin.register'));

        $response->assertStatus(200);
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_pages_require_authentication(): void
    {
        $response = $this->get(route('admin.companies'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('admin.users'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('admin.teams'));
        $response->assertRedirect(route('login'));
    }
}

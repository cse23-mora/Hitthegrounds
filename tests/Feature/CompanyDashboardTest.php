<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('company.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_company_routes(): void
    {
        $response = $this->get(route('company.dashboard'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('company.profile'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('company.teams'));
        $response->assertRedirect(route('login'));
    }
}

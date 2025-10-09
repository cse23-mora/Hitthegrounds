<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_be_created(): void
    {
        $company = Company::create([
            'name' => 'Test Company',
            'phone' => '0771234567',
            'description' => 'A test company',
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'phone' => '0771234567',
        ]);
    }

    public function test_company_has_users_relationship(): void
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);

        $this->assertTrue($company->users->contains($user));
        $this->assertEquals($company->id, $user->company_id);
    }

    public function test_company_has_teams_relationship(): void
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);
        $team = Team::factory()->create([
            'company_id' => $company->id,
            'user_id' => $user->id,
        ]);

        $this->assertTrue($company->teams->contains($team));
        $this->assertEquals($company->id, $team->company_id);
    }

    public function test_company_can_have_multiple_users(): void
    {
        $company = Company::factory()->create();
        $users = User::factory()->count(3)->create(['company_id' => $company->id]);

        $this->assertEquals(3, $company->users()->count());
    }

    public function test_company_can_have_multiple_teams(): void
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);
        $teams = Team::factory()->count(3)->create([
            'company_id' => $company->id,
            'user_id' => $user->id,
        ]);

        $this->assertEquals(3, $company->teams()->count());
    }
}

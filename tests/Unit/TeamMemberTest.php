<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_member_can_be_created(): void
    {
        $team = Team::factory()->create();
        $member = TeamMember::create([
            'team_id' => $team->id,
            'name' => 'John Doe',
            'gender' => 'Male',
            'is_captain' => false,
        ]);

        $this->assertDatabaseHas('team_members', [
            'name' => 'John Doe',
            'gender' => 'Male',
            'team_id' => $team->id,
        ]);
    }

    public function test_team_member_belongs_to_team(): void
    {
        $team = Team::factory()->create();
        $member = TeamMember::factory()->create(['team_id' => $team->id]);

        $this->assertEquals($team->id, $member->team->id);
    }

    public function test_team_member_is_captain_is_boolean(): void
    {
        $member = TeamMember::factory()->create(['is_captain' => true]);

        $this->assertTrue($member->is_captain);
        $this->assertIsBool($member->is_captain);
    }

    public function test_team_member_can_be_male(): void
    {
        $member = TeamMember::factory()->create(['gender' => 'Male']);

        $this->assertEquals('Male', $member->gender);
    }

    public function test_team_member_can_be_female(): void
    {
        $member = TeamMember::factory()->create(['gender' => 'Female']);

        $this->assertEquals('Female', $member->gender);
    }
}

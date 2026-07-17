<?php

namespace Tests\Feature;

use App\Modules\Log\Dto\LogData;
use App\Modules\Log\Models\Log;
use App\Modules\Log\Service\LogService;
use App\Modules\Position\Models\Position;
use App\Modules\Project\Models\Project;
use App\Modules\User\Dto\CreateUserData;
use App\Modules\User\Models\User;
use App\Modules\User\Service\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModularSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_factories_resolve_and_services_persist(): void
    {
        // newFactory() resolution for models moved out of App\Models
        $position = Position::factory()->create(['status' => Position::STATUS_ACTIVE]);
        Project::factory()->create(['status' => Project::STATUS_ACTIVE]);

        // create via service -> factory -> repository
        $userService = app(UserService::class);
        $user = $userService->create(new CreateUserData(
            name: 'John',
            email: 'john@example.com',
            password: 'password123',
            positionId: $position->id,
        ));

        $this->assertDatabaseHas('users', ['email' => 'john@example.com', 'role' => User::ROLE_USER]);
        $this->assertTrue(password_verify('password123', $user->fresh()->password));

        $project = Project::first();
        $logService = app(LogService::class);
        $logService->create($user, new LogData(
            projectId: $project->id,
            text: 'did work',
            link: '',
            time: 2.0,
            date: now()->format('Y-m-d'),
        ));

        $this->assertDatabaseHas('logs', ['user_id' => $user->id, 'text' => 'did work']);
    }

    public function test_admin_routes_render_with_module_binding(): void
    {
        $position = Position::factory()->create(['status' => Position::STATUS_ACTIVE]);
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'position_id' => $position->id,
        ]);
        Project::factory()->count(2)->create(['status' => Project::STATUS_ACTIVE]);
        Log::factory()->count(3)->create(['user_id' => $admin->id]);

        $this->actingAs($admin)->get('/admin/users')->assertOk();
        $this->actingAs($admin)->get('/admin/reports/projects')->assertOk();
        // route-model binding {userId} + log listing
        $this->actingAs($admin)->get('/log/'.$admin->id)->assertOk();
    }
}

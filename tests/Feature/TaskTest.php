<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // GET /projects/{project}/tasks           - tasks.index
    // GET /projects/{project}/tasks/create    - tasks.create
    // POST /projects/{project}/tasks          - tasks.store
    // GET /projects/{project}/tasks/{task}    - tasks.show
    // GET /projects/{project}/tasks/{task}/edit - tasks.edit
    // PUT /projects/{project}/tasks/{task}    - tasks.update
    // DELETE /projects/{project}/tasks/{task} - tasks.destroy

    public function test_task_index(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $tasks = Task::factory()->count(5)->create(['project_id' => $project->id]);

        $response = $this
            ->actingAs($user)
            ->get(route('projects.tasks.index', $project));

        $response->assertOk();
        $response->assertViewIs('task.tasks');
    }

    public function test_list_task(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $tasks = Task::factory()->count(5)->create(['project_id' => $project->id]);

        $response = $this
            ->actingAs($user)
            ->get('tasks/list');

        $response->assertOk();
        $response->assertViewIs('task.index');
    }

    public function test_create(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('projects.tasks.create', $project));

        $response->assertOk();
        $response->assertViewIs('task.create');
        $response->assertViewHas('project', $project);
    }

    public function test_store(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $data = [
            'name' => 'Test Task',
            'description' => 'Test Description',
            'user_id' => $user->id,
            'project_id' => $project->id,
            'priority' => 1,
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('projects.tasks.store', $project), $data);

        $response->assertRedirect();
        $redirectedUrl = $response->headers->get('Location');

        $expectedUrl = route('projects.tasks.index', $project);

        $this->assertEquals($expectedUrl, $redirectedUrl);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this
            ->actingAs($user)
            ->get(route('projects.tasks.show', [$project, $task]));

        $response->assertOk();
        $response->assertViewIs('task.show');
        $response->assertViewHas('project', $project);
        $response->assertViewHas('task', $task);
    }

    public function test_edit(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this
            ->actingAs($user)
            ->get(route('projects.tasks.edit', [$project, $task]));

        $response->assertOk();
        $response->assertViewIs('task.edit');
        $response->assertViewHas('project', $project);
        $response->assertViewHas('task', $task);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $data = [
            'name' => 'Updated Task Title',
            'description' => 'Updated Description',
        ];

        $response = $this
            ->actingAs($user)
            ->put(route('projects.tasks.update', [$project, $task]), $data);

        $response->assertRedirect(route('projects.tasks.show', [$project, $task]));
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);

        $response = $this
            ->actingAs($user)
            ->delete(route('projects.tasks.destroy', [$project, $task]));

        $response->assertRedirect(route('projects.tasks.index', $project));
    }
}
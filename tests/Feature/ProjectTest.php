<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectTest extends TestCase
{
    use RefreshDatabase;


    public function test_project_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/projects');

        $response->assertOk();
        $response->assertViewIs('project.index');
    }

    public function test_create_project_form(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/projects/create');

        $response->assertOk();
        $response->assertViewIs('project.create');
    }

    public function test_store_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->make();

        $data = [
            'name' => $project->name,
            'description' => $project->description,
        ];

        $response = $this
            ->actingAs($user)
            ->post('/projects', $data);


        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('projects.show', Project::latest()->first()->id));
    }

    public function test_show_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('projects.show', $project));

        $response->assertOk();

        $response->assertViewIs('project.show');

        $response->assertViewHas('project', $project);
    }

    public function test_edit_project(): void
    {
        $user = User::factory()->create();

        $project = Project::factory()->create();

        // Simulate a GET request to the edit route for the project
        $response = $this
            ->actingAs($user)
            ->get(route('projects.edit', $project));

        $response->assertOk();

        $response->assertViewIs('project.edit');

        $response->assertViewHas('project', $project);
    }

    public function test_update_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $updatedData = [
            'name' => 'Updated Project Name',
            'description' => 'Updated project description.',
        ];

        $response = $this
            ->actingAs($user)
            ->put(route('projects.update', $project), $updatedData);

        $response
             ->assertSessionHasNoErrors()
            ->assertRedirect(route('projects.show', $project->id));
    }

    public function test_destroy_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));
    }

}
<?php

namespace Tests\Feature;


use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TaskTest extends TestCase
{
    /**
     * A for task creation.
     * @test
     * @return void
     * @throws \JsonException
     */
    public function tasks_can_be_created(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $response =  $this->actingAs($user)->post('/tasks',[
            'title' => 'test task',
            'project_id' => $project->id,
            'description' => 'this is a test task'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    /**
     * A test for task editing view.
     * @test
     * @return void
     * @throws \JsonException
     */
    public function tasks_can_be_edited(): void
    {
        $user = User::factory()->create();
        $task = Task::findOrFail(1);
        $response =  $this->actingAs($user)->get('/tasks/edit/'.$task->slug);
        $response->assertStatus(200);
    }

    /**
     * A test for task updating.
     * @test
     * @return void
     * @throws \JsonException
     */
    public function tasks_can_be_updated(): void
    {
        $user = User::factory()->create();
        $task = Task::findOrFail(1);
        $response =  $this->actingAs($user)->put('/tasks/update/'.$task->slug,[
            'title' => 'test updated'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    /**
     * A test for task updating.
     * @test
     * @return void
     * @throws \JsonException
     */
    public function tasks_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $task = Task::findOrFail(1);
        $response =  $this->actingAs($user)->delete('/tasks/delete/'.$task->slug);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }




}

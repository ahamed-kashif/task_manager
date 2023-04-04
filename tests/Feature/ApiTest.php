<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A feature test for fetching tasks through api.
     * @test
     * @return void
     */
    public function tasks_can_be_fetched_through_api(): void
    {
        $user = User::factory()->create();
        $token = $user->generateToken();
        \App\Models\Project::factory(1)->has(Task::factory(10))->create();
        $project = Project::orderBy('created_at','desc')->firstOrFail();
        $response = $this
            ->get('/api/axios/fetch-tasks/'.$project->slug.'?api_token='.$token);
        $response->assertOk();
        $this->assertCount($project->tasks()->count(),$response['data']);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test for task priority update through api.
     * @test
     * @return void
     * @throws \JsonException
     */
    public function tasks_priority_can_be_updated_through_api(): void
    {
        $user = User::factory()->create();
        $token = $user->generateToken();
        $tasks = Task::orderBy('created_at','asc')->get()->map(function($task){
           return [
               'id' => $task->id,
               'priority' => $task->id
           ] ;
        })->toArray();
        $response = $this
            ->post('/api/axios/update-tasks-priority',[
                'api_token' => $token,
                'list' => $tasks
            ]);
        $response->assertOk();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(200);
    }

}

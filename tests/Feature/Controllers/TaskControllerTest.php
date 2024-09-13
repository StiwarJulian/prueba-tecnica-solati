<?php

namespace Tests\Feature\Controllers;

use App\Models\Task;

class TaskControllerTest extends \Tests\TestCase
{
    public function test_returns_a_successful_response(): void
    {
        $response = $this->get('api/tasks');

        $response->assertStatus(200);
    }

    public function test_returns_a_successful_response_when_creating_a_task(): void
    {
        $response = $this->post('api/tasks', [
            'title' => 'Task title',
            'description' => 'Task description',
            'status' => 'pendiente',
        ]);

        $response->assertStatus(201);
    }

    public function test_returns_a_successful_response_when_updating_a_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->put("api/tasks/{$task->id}", [
            'title' => 'Task title',
            'description' => 'Task description',
            'status' => 'pendiente',
        ]);

        $response->assertStatus(200);
    }

    public function test_returns_a_successful_response_when_deleting_a_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete("api/tasks/{$task->id}");

        $response->assertStatus(200);
    }
}

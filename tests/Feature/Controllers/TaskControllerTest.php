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

    public function test_returns_not_found_response_when_retrieving_a_non_existent_task(): void
    {
        $response = $this->get('api/tasks/1');

        $response->assertStatus(404);
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

    public function test_returns_a_bad_request_error_when_creating_a_task_with_invalid_data(): void
    {
        $response = $this->post('api/tasks', [
            'title' => 'Task title',
            'description' => 'Task description',
        ]);

        $response->assertStatus(422);
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

    // retorna 404 cuando se intenta actualizar una tarea que no existe
    public function test_returns_not_found_response_when_updating_a_non_existent_task(): void
    {
        $response = $this->put('api/tasks/1', [
            'title' => 'Task title',
            'description' => 'Task description',
            'status' => 'pendiente',
        ]);

        $response->assertStatus(404);
    }

    public function test_returns_a_successful_response_when_deleting_a_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete("api/tasks/{$task->id}");

        $response->assertStatus(200);
    }

    public function test_returns_not_found_response_when_deleting_a_non_existent_task(): void
    {
        $response = $this->delete('api/tasks/1');

        $response->assertStatus(404);
    }
}

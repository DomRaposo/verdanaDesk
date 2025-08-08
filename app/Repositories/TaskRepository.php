<?php

namespace App\Repositories;

use App\Models\Task;
use App\Enums\StatusTaskEnum;

class TaskRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Task::all();
    }

    public function findById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function close(Task $task): bool
    {
        return $task->update(['status' => StatusTaskEnum::ENCERRADO->value]);
    }

    public function count(): int
    {
        return Task::count();
    }

    public function getByStatus(string $status): \Illuminate\Database\Eloquent\Collection
    {
        return Task::where('status', $status)->get();
    }
}
 
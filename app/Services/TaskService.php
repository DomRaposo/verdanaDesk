<?php

namespace App\Services;

use App\Enums\StatusTaskEnum;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskService
{
    protected $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->getAll()
            ->map(fn($c) => [
                'id'         => $c->id,
                'title'      => $c->title,
                'description' => $c->description,
                'status'     => $this->mapStatusToEnglish($c->status->value),
                'priority'   => $c->priority ?? 'medium',
                'created_at' => $c->created_at,
                'updated_at' => $c->updated_at,
                'user_id'    => $c->user_id,
            ]);
    }

    private function mapStatusToEnglish(string $status): string
    {
        return match($status) {
            'ABERTO' => 'open',
            'EM_ATENDIMENTO' => 'in_progress',
            'ENCERRADO' => 'closed',
            default => 'open'
        };
    }

    public function filterByStatus($status)
    {
        return $this->repository->getByStatus($status);
    }

    public function closeChamado($id)
    {
        $chamado = $this->repository->findById($id);

        if (!$chamado) {
            throw new \Exception('Chamado não encontrado');
        }

        $updated = $this->repository->update($chamado, ['status' => StatusTaskEnum::ENCERRADO->value]);
        
        if ($updated) {
            return [
                'id' => $chamado->id,
                'title' => $chamado->title,
                'status' => 'closed',
                'message' => 'Chamado fechado com sucesso'
            ];
        }
        
        throw new \Exception('Erro ao fechar chamado');
    }

    public function store($data)
    {
        $data['user_id'] = auth()->id();
        $data['data_abertura'] = Carbon::now()->toDateString();

        $task = $this->repository->create($data);

        return [
            'id' => $task->id,
            'title' => $task->title,
            'status' => $this->mapStatusToEnglish($task->status->value),
            'priority' => $task->priority ?? 'medium',
            'message' => 'Chamado criado com sucesso'
        ];
    }

    public function show($id)
    {
        $task = $this->repository->findById($id);

        if (!$task) return null;

        $user = auth()->user();

        return [
            'id'           => $task->id,
            'title'        => $task->title,
            'description'  => $task->description,
            'status'       => $this->mapStatusToEnglish($task->status->value),
            'priority'     => $task->priority ?? 'medium',
        ];
    }

    public function destroy($id)
    {
        $task = $this->repository->findById($id);
        
        if (!$task) {
            throw new \Exception('Chamado não encontrado');
        }

        $deleted = $this->repository->delete($task);
        
        if ($deleted) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'message' => 'Chamado excluído com sucesso'
            ];
        }
        
        throw new \Exception('Erro ao excluir chamado');
    }

    private function getStatusStats(string $status): array
    {
        return [
            'count' => $this->repository->getByStatus($status)->count()
        ];
    }
        
    public function update($id, $data)
    {
        $task = $this->repository->findById($id);
        if (!$task) {
            throw new \Exception('Chamado não encontrado');
        }

        $this->repository->update($task, $data);
        $updatedTask = $task->fresh();
        
        return [
            'id' => $updatedTask->id,
            'title' => $updatedTask->title,
            'description' => $updatedTask->description,
            'status' => $this->mapStatusToEnglish($updatedTask->status->value),
            'priority' => $updatedTask->priority ?? 'medium',
            'message' => 'Chamado atualizado com sucesso'
        ];
    }
}

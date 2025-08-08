<?php
namespace App\Enums;

enum StatusTaskEnum: string
{
    case ABERTO = 'ABERTO';
    case EM_ATENDIMENTO = 'EM_ATENDIMENTO';
    case ENCERRADO = 'ENCERRADO';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

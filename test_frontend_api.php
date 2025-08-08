<?php

// Simulando a chamada do frontend
$taskId = 1;
$url = "http://localhost:8000/api/tasks/{$taskId}/close";

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST'
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "Status Code: " . $http_response_header[0] . "\n";
echo "Response: " . $result . "\n";

// Verificar se a tarefa foi atualizada
echo "\n--- Verificando tarefa atualizada ---\n";
$checkUrl = "http://localhost:8000/api/tasks/{$taskId}";
$checkResult = file_get_contents($checkUrl);
echo "Tarefa atualizada: " . $checkResult . "\n";

// Verificar todas as tarefas
echo "\n--- Verificando todas as tarefas ---\n";
$allTasksUrl = "http://localhost:8000/api/tasks";
$allTasksResult = file_get_contents($allTasksUrl);
echo "Todas as tarefas: " . $allTasksResult . "\n";
?>





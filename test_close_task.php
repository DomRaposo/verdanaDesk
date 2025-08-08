<?php

// Teste da API de encerrar tarefa
$taskId = 1; // ID da primeira tarefa
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
?>






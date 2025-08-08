<?php

// Teste da API de criação de tarefa sem priority
$url = 'http://localhost:8000/api/tasks/create';
$data = [
    'title' => 'Teste sem Priority',
    'description' => 'Esta é uma tarefa de teste sem campo priority',
    'status' => 'ABERTO'
];

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "Status Code: " . $http_response_header[0] . "\n";
echo "Response: " . $result . "\n";

// Verificar se a tarefa foi criada
echo "\n--- Verificando tarefa criada ---\n";
$checkUrl = "http://localhost:8000/api/tasks";
$checkResult = file_get_contents($checkUrl);
echo "Todas as tarefas: " . $checkResult . "\n";
?>


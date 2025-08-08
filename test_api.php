<?php

// Teste da API de criação de tarefas
$url = 'http://localhost:8000/api/tasks/create';
$data = [
    'title' => 'Teste via PHP',
    'description' => 'Descrição de teste via PHP',
    'priority' => 'medium',
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
?>






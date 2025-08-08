<?php

$taskId = 3;
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
?>

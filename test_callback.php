<?php
// Test callback manually
$data = [
    'action' => 'on_publish',
    'stream' => 'stream_2_68fa0d1b3a78f'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/srs-callback.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Host: tsport-new.localhost'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";

// Check if log file was updated
$logFile = dirname(__DIR__) . '/storage/logs/srs-callback.log';
if (file_exists($logFile)) {
    $logs = file_get_contents($logFile);
    $lines = explode("\n", trim($logs));
    echo "\nLast 3 log entries:\n";
    foreach (array_slice($lines, -3) as $line) {
        echo "$line\n";
    }
}
?>

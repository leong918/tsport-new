<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Parse JSON input
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$stream = $input['stream'] ?? '';

// Simple logging
$logFile = dirname(__DIR__) . '/storage/logs/srs-callback.log';
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'action' => $action,
    'stream' => $stream,
    'host' => $_SERVER['HTTP_HOST'] ?? 'unknown'
];

@file_put_contents($logFile, json_encode($logData) . "\n", FILE_APPEND);

// Database connection
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=tsport-new", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($stream) {
        $stmt = $pdo->prepare("SELECT id FROM live_match WHERE obs_stream_key = ?");
        $stmt->execute([$stream]);
        $match = $stmt->fetch();
        
        if ($match) {
            $status = ($action === 'on_publish') ? 2 : 0;
            $timeField = ($action === 'on_publish') ? 'stream_started_at' : 'stream_ended_at';
            
            $updateStmt = $pdo->prepare("UPDATE live_match SET obs_status = ?, $timeField = NOW() WHERE id = ?");
            $updateStmt->execute([$status, $match['id']]);
            
            @file_put_contents($logFile, "Updated match {$match['id']}: status=$status\n", FILE_APPEND);
        }
    }
    
    echo json_encode(['code' => 0]);
} catch (Exception $e) {
    @file_put_contents($logFile, "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['code' => 0]); // Still return success to SRS
}
?>

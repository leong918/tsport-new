<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=tsport-new', 'root', '');
    echo "Database connection successful\n";
    
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM live_match');
    $result = $stmt->fetch();
    echo "Live matches count: " . $result['count'] . "\n";
    
    $stmt = $pdo->query('SELECT id, obs_stream_key, obs_status FROM live_match LIMIT 5');
    while($row = $stmt->fetch()) {
        echo "ID: {$row['id']}, Stream Key: {$row['obs_stream_key']}, Status: {$row['obs_status']}\n";
    }
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>

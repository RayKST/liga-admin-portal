<?php

require __DIR__ . '/../../src/middleware/auth.php';

requireAuthentication();

header('Content-Type: application/json');

$pdo = require_once __DIR__ . '/../../src/config/database.php';

header('Content-Type: application/json');

try {
    
    $stmt = $pdo->query('SELECT * FROM cards');

    $cards = $stmt->fetchAll();

    echo json_encode([
        'data' => $cards
    ]);

} catch (PDOException $e) {
    http_response_code(500);

    echo json_encode([
        'error' => 'Database error'
    ]);
}
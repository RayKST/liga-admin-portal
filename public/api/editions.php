<?php

require __DIR__ . '/../../src/middleware/auth.php';

requireAuthentication();

header('Content-Type: application/json');

$game = $_GET['game'] ?? '';

$allowedGames = [
    'magic',
    'pokemon',
    'yugioh'
];

if (!in_array($game, $allowedGames, true)) {

    http_response_code(422);

    echo json_encode([
        'error' => 'Invalid game'
    ]);

    exit;
}


$file = __DIR__ . '/../../utils/editions.json';

if (!file_exists($file)) {

    http_response_code(500);

    echo json_encode([
        'error' => 'Editions file not found'
    ]);

    exit;
}


$json = file_get_contents($file);

$data = json_decode($json, true);


if (!is_array($data)) {

    http_response_code(500);

    echo json_encode([
        'error' => 'Invalid editions JSON'
    ]);

    exit;
}


echo json_encode(
    $data[$game] ?? []
);
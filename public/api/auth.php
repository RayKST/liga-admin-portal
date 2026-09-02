<?php

session_start();

header('Content-Type: application/json');

$pdo = require __DIR__ . '/../../src/config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

# Method to auth user
if ($method === 'POST') {

    $input = json_decode(
        file_get_contents('php://input'),
        true
    );

    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    if ($email === '' || $password === '') {
        http_response_code(422);

        echo json_encode([
            'error' => 'Email and password are required'
        ]);

        exit;
    }

    $stmt = $pdo->prepare(
        'SELECT id, email, password
         FROM users
         WHERE email = :email
         LIMIT 1'
    );

    $stmt->execute([
        'email' => $email
    ]);

    $user = $stmt->fetch();

    if (
        !$user ||
        !password_verify($password, $user['password'])
    ) {
        http_response_code(401);

        echo json_encode([
            'error' => 'Invalid email or password'
        ]);

        exit;
    }

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];

    echo json_encode([
        'authenticated' => true,
        'user' => [
            'id' => $user['id'],
            'email' => $user['email']
        ]
    ]);

    exit;
}

# Method to check if user is authenticated
if ($method === 'GET') {

    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);

        echo json_encode([
            'authenticated' => false
        ]);

        exit;
    }

    echo json_encode([
        'authenticated' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'email' => $_SESSION['user_email']
        ]
    ]);

    exit;
}

http_response_code(405);

echo json_encode([
    'error' => 'Method not allowed'
]);
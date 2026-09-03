<?php

function requireAuthentication(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['user_id'])) {
        return;
    }

    // API request
    if (str_starts_with($_SERVER['REQUEST_URI'], '/api/')) {
        header('Content-Type: application/json');

        http_response_code(401);

        echo json_encode([
            'error' => 'Unauthorized'
        ]);

        exit;
    }

    // Normal page request
    header('Location: /login.php');
    exit;
}
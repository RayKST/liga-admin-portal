<?php

function requireAuthentication(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header('Content-Type: application/json');

        http_response_code(401);

        echo json_encode([
            'error' => 'Unauthorized'
        ]);

        exit;
    }
}
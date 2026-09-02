<?php

try {
    $db = require __DIR__ . '/../src/config/database.php';

    $result = $db->query('SELECT 1');

    echo '<h1>Card Portal</h1>';
    echo '<p>PHP is working!</p>';
    echo '<p>MySQL connection successful!</p>';

} catch (Throwable $error) {
    http_response_code(500);

    echo '<h1>Database connection failed</h1>';
    echo '<pre>';
    echo htmlspecialchars($error->getMessage());
    echo '</pre>';
}
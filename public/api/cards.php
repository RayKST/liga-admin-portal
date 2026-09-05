<?php

require __DIR__ . '/../../src/middleware/auth.php';
require __DIR__ . '/validators/card-validator.php';

requireAuthentication();

header('Content-Type: application/json');

$pdo = require_once __DIR__ . '/../../src/config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET'){
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
};


if ($method === 'POST') {

    $input = json_decode(
        file_get_contents('php://input'),
        true
    );


    if (!$input) {

        http_response_code(400);

        echo json_encode([
            'error' => 'Invalid JSON'
        ]);

        exit;
    }

    $validation = validateCard($input);

    if (isset($validation['error'])) {
        http_response_code(422);

        echo json_encode([
            'error' => $validation['error']
        ]);

        exit;
    }

    $card = $validation['data'];

    $editionName = validateEdition(
        $card['card_game'],
        $card['edition_id']
    );

    if ($editionName === null) {
        http_response_code(422);

        echo json_encode([
            'error' => 'Invalid edition'
        ]);

        exit;
    }


    /*
     * Insert card.
     */

    $stmt = $pdo->prepare(
    'INSERT INTO cards (
        name_en,
        name_pt,
        card_game,
        edition_id,
        edition_name,
        image,
        rarity
    )
    VALUES (
        :name_en,
        :name_pt,
        :card_game,
        :edition_id,
        :edition_name,
        :image,
        :rarity
        )'
    );

    $stmt->execute([
        'name_en' => $card['name_en'],
        'name_pt' => $card['name_pt'],
        'card_game' => $card['card_game'],
        'edition_id' => $card['edition_id'],
        'edition_name' => $editionName,
        'image' => $card['image'],
        'rarity' => $card['rarity']
    ]);


    $cardId = $pdo->lastInsertId();


    http_response_code(201);

    echo json_encode([

        'message' => 'Card created successfully',

        'card' => [
            'id' => $cardId,
            'name_en' => $card['name_en'],
            'name_pt' => $card['name_pt'],
            'card_game' => $card['card_game'],
            'edition_id' => $card['edition_id'],
            'edition_name' => $editionName,
            'image' => $card['image'],
            'rarity' => $card['rarity']
        ]

    ]);

    exit;
}

if ($method === 'PUT') {

    // Get card ID
    $cardId = $_GET['id'] ?? null;

    if (!$cardId || !ctype_digit($cardId)) {
        http_response_code(400);

        echo json_encode([
            'error' => 'Invalid card ID'
        ]);

        exit;
    }

    $cardId = (int) $cardId;


    // Read JSON body
    $input = json_decode(
        file_get_contents('php://input'),
        true
    );


    if (!$input) {
        http_response_code(400);

        echo json_encode([
            'error' => 'Invalid JSON'
        ]);

        exit;
    }


    $validation = validateCard($input);

    if (isset($validation['error'])) {
        http_response_code(422);

        echo json_encode([
            'error' => $validation['error']
        ]);

        exit;
    }

    $card = $validation['data'];

    $editionName = validateEdition(
        $card['card_game'],
        $card['edition_id']
    );

    if ($editionName === null) {
        http_response_code(422);

        echo json_encode([
            'error' => 'Invalid edition'
        ]);

        exit;
    }


    // Update

    $stmt = $pdo->prepare(
        'UPDATE cards
            SET
            name_en = :name_en,
            name_pt = :name_pt,
            card_game = :card_game,
            edition_id = :edition_id,
            edition_name = :edition_name,
            image = :image,
            rarity = :rarity
        WHERE id = :id'
    );

    $stmt->execute([
        'name_en' => $card['name_en'],
        'name_pt' => $card['name_pt'],
        'card_game' => $card['card_game'],
        'edition_id' => $card['edition_id'],
        'edition_name' => $editionName,
        'image' => $card['image'],
        'rarity' => $card['rarity'],
        'id' => $cardId
    ]);


    if ($stmt->rowCount() === 0) {


        $check = $pdo->prepare(
            'SELECT id FROM cards WHERE id = :id'
        );

        $check->execute([
            'id' => $cardId
        ]);

        if (!$check->fetch()) {
            http_response_code(404);

            echo json_encode([
                'error' => 'Card not found'
            ]);

            exit;
        }
    }


    echo json_encode([
        'message' => 'Card updated successfully'
    ]);

    exit;
}


if ($method === 'DELETE') {

    $cardId = $_GET['id'] ?? null;

    // Validate ID
    if (!$cardId || !ctype_digit($cardId)) {
        http_response_code(400);

        echo json_encode([
            'error' => 'Invalid card ID'
        ]);

        exit;
    }

    $cardId = (int) $cardId;

    $stmt = $pdo->prepare(
        'DELETE FROM cards WHERE id = :id'
    );

    $stmt->execute([
        'id' => $cardId
    ]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);

        echo json_encode([
            'error' => 'Card not found'
        ]);

        exit;
    }

    // Success
    echo json_encode([
        'message' => 'Card deleted successfully'
    ]);

    exit;
}
<?php

require __DIR__ . '/../src/middleware/auth.php';
$pdo = require __DIR__ . '/../src/config/database.php';

requireAuthentication();

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: /');
    exit;
}

$cardId = (int) $_GET['id'];

$stmt = $pdo->prepare(
    'SELECT
        id,
        name_en,
        name_pt,
        card_game,
        edition_id,
        edition_name,
        image,
        rarity
    FROM cards
    WHERE id = :id'
);

$stmt->execute([
    'id' => $cardId
]);

$card = $stmt->fetch();

if (!$card) {
    http_response_code(404);
    exit('Card not found');
}

$mode = 'edit';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Card - Card Portal</title>

    <link
        rel="stylesheet"
        href="/assets/css/index.css"
    >
</head>

    <body>

        <header class="header">
            <div class="container header-content">

                <a href="/" class="logo">
                    Card Portal
                </a>

                <a href="/" class="button">
                    Back to Cards
                </a>

            </div>
        </header>


        <main class="container">

            <section class="page-header">
                <div>
                    <h1>Edit Card</h1>

                    <p>
                        Update the card information.
                    </p>
                </div>
            </section>


            <section class="form-container">

                <?php
                require __DIR__ . '/components/card-form.php';
                ?>

            </section>

        </main>


        <script src="/assets/js/card-form.js"></script>

    </body>
</html>
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

<html lang="pt-BR">
    <head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar Card - Card Portal</title>

    <link
        rel="stylesheet"
        href="/assets/css/global.css"
    >

    <link
        rel="stylesheet"
        href="/assets/css/card-create.css"
    >

</head>

<body>

    <header class="site-header">

        <div class="header-content">

            <a
                href="/"
                class="logo"
            >
                Card Portal
            </a>

            <a
                href="/"
                class="button button-secondary"
            >
                Voltar para Cards
            </a>

        </div>

    </header>

    <main class="main-content">

        <div class="create-content">

            <section class="page-header">

                <div class="page-header-info">

                    <h1>
                        Editar Card
                    </h1>

                    <p>
                        Atualize as informações do card.
                    </p>

                </div>

            </section>

            <section class="form-section">

                <div class="form-card">

                    <?php
                    require __DIR__ . '/components/card-form.php';
                    ?>

                </div>

            </section>

        </div>

    </main>

    <?php require __DIR__ . '/components/footer.php'; ?>

    <script src="/assets/js/card-form.js"></script>

</body>

</html>

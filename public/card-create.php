<?php

require __DIR__ . '/../src/middleware/auth.php';

requireAuthentication();

$mode = 'create';

?>

<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Adicionar Card - Card Portal</title>

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
                        Adicionar Card
                    </h1>

                    <p>
                        Adicione um novo card à sua coleção.
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
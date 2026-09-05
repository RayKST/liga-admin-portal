<?php

require __DIR__ . '/../src/middleware/auth.php';

requireAuthentication();

?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="UTF-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >

        <title>Card Portal - Liga Magic</title>

        <link
            rel="stylesheet"
            href="/assets/css/global.css"
        >

        <link
            rel="stylesheet"
            href="/assets/css/index.css"
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


            <div class="header-user">

                <span class="user-email">
                    <?= htmlspecialchars($_SESSION['user_email']) ?>
                </span>

                <button
                    id="logout-button"
                    class="button button-danger button-secondary"
                    type="button"
                >
                    Sair
                </button>

            </div>

        </div>

    </header>


    <main class="main-content">

        <section class="page-header">

            <div class="page-header-info">

                <span class="page-eyebrow">
                    Liga Magic
                </span>

                <h1>
                    Card Manager
                </h1>

                <p>
                    Gerencie sua coleção de cards.
                </p>

            </div>


            <a
                href="/card-create.php"
                class="button button-primary"
            >
                <span class="button-icon">+</span>
                Adicionar Card
            </a>

        </section>


        <section class="cards-section">

            <div class="cards-header">

                <div>

                    <h2>
                        Cards
                    </h2>

                    <p>
                        Sua coleção
                    </p>

                </div>


                <span id="card-count">
                    Loading...
                </span>

            </div>


            <div
                id="cards-grid"
                class="cards-grid"
            ></div>


            <div
                id="cards-error"
                class="error-message"
            ></div>

        </section>

    </main>


    <?php require __DIR__ . '/components/footer.php'; ?>


    <script src="/assets/js/index.js"></script>

    </body>

</html>
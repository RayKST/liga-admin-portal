<?php

require __DIR__ . '/../src/middleware/auth.php';

requireAuthentication();

$mode = 'create';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >

        <title>Add Card - Card Portal</title>

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
                <h1>Add Card</h1>
                <p>Create a new card in your collection.</p>
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
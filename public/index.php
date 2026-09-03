<?php

require __DIR__ . '/../src/middleware/auth.php';

requireAuthentication();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Card Portal</title>

    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>

    <header class="header">
        <div class="container header-content">

            <a href="/" class="logo">
                Card Portal
            </a>

            <div class="user-menu">
                <span>
                    <?= htmlspecialchars($_SESSION['user_email']) ?>
                </span>

                <button id="logout-button">
                    Logout
                </button>
            </div>

        </div>
    </header>


    <main class="container">

        <section class="page-header">

            <div>
                <h1>Card Manager</h1>

                <p>
                    Manage your card collection
                </p>
            </div>

            <a href="/card-create.php" class="button">
                + Add Card
            </a>

        </section>


        <section class="filters">

            <input
                type="search"
                id="search"
                placeholder="Search cards..."
            >

            <select id="game-filter">
                <option value="">All games</option>
                <option value="magic">Magic</option>
                <option value="pokemon">Pokémon</option>
                <option value="yugioh">Yu-Gi-Oh!</option>
            </select>

            <select id="rarity-filter">
                <option value="">All rarities</option>
                <option value="common">Common</option>
                <option value="uncommon">Uncommon</option>
                <option value="rare">Rare</option>
                <option value="mythic">Mythic Rare</option>
            </select>

        </section>


        <section>
            <div class="cards-header">
                <h2>Cards</h2>
                <span id="card-count"></span>
            </div>

            <div id="cards-loading" class="loading">
                Loading cards...
            </div>

            <div id="cards-grid" class="cards-grid"></div>

            <div id="cards-error" class="error-message"></div>
        </section>

    </main>


    <script src="/assets/js/index.js"></script>

</body>
</html>
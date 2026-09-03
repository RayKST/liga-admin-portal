<?php

require __DIR__ . '/../src/middleware/auth.php';

requireAuthentication();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Add Card - Card Portal</title>

        <link rel="stylesheet" href="/assets/css/index.css">
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

            <form id="card-form" onsubmit="return confirm('Are you sure you want to submit?');">

                
                <div class="form-group">

                    <label for="name-en">
                        English Name
                    </label>

                    <input
                        type="text"
                        id="name-en"
                        name="name_en"
                        required
                    >

                </div>


                
                <div class="form-group">

                    <label for="name-pt">
                        Portuguese Name
                        <span>(optional)</span>
                    </label>

                    <input
                        type="text"
                        id="name-pt"
                        name="name_pt"
                    >

                </div>


                
                <div class="form-group">

                    <label for="card-game">
                        Card Game
                    </label>

                    <select
                        id="card-game"
                        name="card_game"
                        required
                    >
                        <option value="">
                            Select a game
                        </option>

                        <option value="magic">
                            Magic: The Gathering
                        </option>

                        <option value="pokemon">
                            Pokémon
                        </option>

                        <option value="yugioh">
                            Yu-Gi-Oh!
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="edition">
                        Edition
                    </label>

                    <select
                        id="edition"
                        name="edition_id"
                        disabled
                        required
                    >
                        <option value="">
                            Select a game first
                        </option>
                    </select>

                </div>


                <div class="form-group">

                    <label for="image">
                        Image URL
                    </label>

                    <input
                        type="url"
                        id="image"
                        name="image"
                        placeholder="https://example.com/card.jpg"
                    >

                </div>


                <div class="form-group">

                    <label for="rarity">
                        Rarity
                    </label>

                    <select
                        id="rarity"
                        name="rarity"
                        required
                    >

                        <option value="">
                            Select rarity
                        </option>

                        <option value="Common">
                            Common
                        </option>

                        <option value="Uncommon">
                            Uncommon
                        </option>

                        <option value="Rare">
                            Rare
                        </option>

                        <option value="Mythic">
                            Mythic
                        </option>

                    </select>

                </div>


                <div id="form-error" class="error-message"></div>


                <div class="form-actions">

                    <a
                        href="/"
                        class="button button-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button"
                        id="submit-button"
                    >
                        Create Card
                    </button>

                </div>

            </form>

        </section>

    </main>


    <script src="/assets/js/card-form.js"></script>

    </body>
</html>
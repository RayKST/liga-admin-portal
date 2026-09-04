<?php

// outside param
$isEdit = $mode === 'edit';

// outside param
$card = $card ?? [
    'id' => null,
    'name_en' => '',
    'name_pt' => '',
    'card_game' => '',
    'edition_id' => '',
    'edition_name' => '',
    'image' => '',
    'rarity' => ''
];

?>

<form
    id="card-form"
    data-mode="<?= $isEdit ? 'edit' : 'create' ?>"
    data-card-id="<?= htmlspecialchars((string) ($card['id'] ?? '')) ?>"
    onsubmit="return confirm('Are you sure you want to submit?');"
>

    <div class="form-group">
        <label for="name-en">
            English Name
        </label>

        <input
            type="text"
            id="name-en"
            name="name_en"
            value="<?= htmlspecialchars($card['name_en'] ?? '') ?>"
            required
        >
    </div>


    <div class="form-group">
        <label for="name-pt">
            Portuguese Name (optional)
        </label>

        <input
            type="text"
            id="name-pt"
            name="name_pt"
            value="<?= htmlspecialchars($card['name_pt'] ?? '') ?>"
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

            <option
                value="magic"
                <?= $card['card_game'] === 'magic' ? 'selected' : '' ?>
            >
                Magic: The Gathering
            </option>

            <option
                value="pokemon"
                <?= $card['card_game'] === 'pokemon' ? 'selected' : '' ?>
            >
                Pokémon
            </option>

            <option
                value="yugioh"
                <?= $card['card_game'] === 'yugioh' ? 'selected' : '' ?>
            >
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
            <?= empty($card['card_game']) ? 'disabled' : '' ?>
            required
        >
            <?php if (empty($card['card_game'])): ?>

                <option value="">
                    Select a game first
                </option>

            <?php else: ?>

                <option value="<?= htmlspecialchars($card['edition_id']) ?>">
                    <?= htmlspecialchars($card['edition_name']) ?>
                </option>

            <?php endif; ?>

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
            value="<?= htmlspecialchars($card['image'] ?? '') ?>"
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
            <option value="">Select rarity</option>

            <option
                value="Common"
                <?= $card['rarity'] === 'Common' ? 'selected' : '' ?>
            >
                Common
            </option>

            <option
                value="Uncommon"
                <?= $card['rarity'] === 'Uncommon' ? 'selected' : '' ?>
            >
                Uncommon
            </option>

            <option
                value="Rare"
                <?= $card['rarity'] === 'Rare' ? 'selected' : '' ?>
            >
                Rare
            </option>

            <option
                value="Mythic Rare"
                <?= $card['rarity'] === 'Mythic Rare' ? 'selected' : '' ?>
            >
                Mythic Rare
            </option>
        </select>
    </div>


    <div
        id="form-error"
        class="error-message"
    ></div>


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
            <?= $isEdit ? 'Save Changes' : 'Create Card' ?>
        </button>

    </div>

</form>
const form = document.querySelector('#card-form');

const gameSelect = document.querySelector('#card-game');
const editionSelect = document.querySelector('#edition');

const errorMessage = document.querySelector('#form-error');
const submitButton = document.querySelector('#submit-button');


gameSelect.addEventListener('change', async () => {

    const game = gameSelect.value;

    if (!game) {

        editionSelect.disabled = true;

        editionSelect.innerHTML = `
            <option value="">
                Select a game first
            </option>
        `;

        return;
    }

    await loadEditions(game);
});


form.addEventListener('submit', async (event) => {
    event.preventDefault();

    errorMessage.textContent = '';

    const mode = form.dataset.mode;
    const cardId = form.dataset.cardId;

    submitButton.disabled = true;

    submitButton.textContent =
        mode === 'edit'
            ? 'Saving...'
            : 'Creating...';

    const formData = new FormData(form);

    const card = {
        name_en: formData.get('name_en'),
        name_pt: formData.get('name_pt') || null,
        card_game: formData.get('card_game'),
        edition_id: formData.get('edition_id'),
        image: formData.get('image') || null,
        rarity: formData.get('rarity')
    };

    try {

        const url =
            mode === 'edit'
                ? `/api/cards.php?id=${cardId}`
                : '/api/cards.php';

        const method =
            mode === 'edit'
                ? 'PUT'
                : 'POST';

        const response = await fetch(url, {
            method: method,

            headers: {
                'Content-Type': 'application/json'
            },

            body: JSON.stringify(card)
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.error ||
                'Failed to save card'
            );
        }

        alert(
            mode === 'edit'
                ? 'Card updated!'
                : 'Card created!'
        );

        window.location.href = '/';

    } catch (error) {

        console.error(error);

        errorMessage.textContent =
            error.message ||
            'Failed to save card';

        submitButton.disabled = false;

        submitButton.textContent =
            mode === 'edit'
                ? 'Save Changes'
                : 'Create Card';
    }
});


async function loadEditions(game, selectedEditionId = '') {

    editionSelect.disabled = true;

    editionSelect.innerHTML = `
        <option value="">
            Loading editions...
        </option>
    `;

    try {

        const response = await fetch(
            `/api/editions.php?game=${encodeURIComponent(game)}`
        );

        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.error || 'Failed to load editions'
            );
        }

        editionSelect.innerHTML = `
            <option value="">
                Select an edition
            </option>
        `;

        data.forEach(edition => {

            const option = document.createElement('option');

            option.value = edition.id;
            option.textContent = edition.name;

            if (edition.id === selectedEditionId) {
                option.selected = true;
            }

            editionSelect.appendChild(option);
        });

        editionSelect.disabled = false;

    } catch (error) {

        console.error(error);

        editionSelect.innerHTML = `
            <option value="">
                Failed to load editions
            </option>
        `;
    }
}
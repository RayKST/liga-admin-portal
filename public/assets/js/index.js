const cardsGrid = document.querySelector('#cards-grid');
const cardsError = document.querySelector('#cards-error');
const cardCount = document.querySelector('#card-count');
const logoutButton = document.getElementById('logout-button');


function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value ?? '';

    return div.innerHTML;
}


function renderCards(cards) {

    cardsGrid.innerHTML = '';

    if (cards.length === 0) {

        cardsGrid.innerHTML = `
            <div class="empty-state">
                <h3>No cards found</h3>
                <p>Try changing your filters.</p>
            </div>
        `;

        return;
    }


    cards.forEach(card => {

        const article = document.createElement('article');

        article.className = 'card';


        article.innerHTML = `
            <div class="card-image">

                ${
                    card.image
                        ? `
                            <img
                                src="${escapeHtml(card.image)}"
                                alt="${escapeHtml(card.name_en)}"
                            >
                        `
                        : `
                            <div class="no-image">
                                No image
                            </div>
                        `
                }

            </div>


            <div class="card-content">

                <h3>
                    ${escapeHtml(card.name_en)}
                </h3>


                <div class="card-meta">

                    ${
                        card.name_pt
                            ? `
                                <div class="card-meta-item">

                                    <span class="card-meta-label">
                                        Nome em português
                                    </span>

                                    <span class="card-meta-value secondary">
                                        ${escapeHtml(card.name_pt)}
                                    </span>

                                </div>
                            `
                            : ''
                    }


                    <div class="card-meta-item">

                        <span class="card-meta-label">
                            Jogo
                        </span>

                        <span class="card-meta-value">
                            ${escapeHtml(card.card_game)}
                        </span>

                    </div>


                    <div class="card-meta-item">

                        <span class="card-meta-label">
                            Edição
                        </span>

                        <span class="card-meta-value">
                            ${escapeHtml(card.edition_name)}
                        </span>

                    </div>


                    <div class="card-meta-item">

                        <span class="card-meta-label">
                            Raridade
                        </span>

                        <span class="card-meta-value">
                            ${escapeHtml(card.rarity)}
                        </span>

                    </div>

                </div>


                <div class="card-actions">

                    <a
                        href="/card-edit.php?id=${encodeURIComponent(card.id)}"
                        class="button button-secondary"
                    >
                        Editar
                    </a>


                    <button
                        class="button button-danger delete-card"
                        data-card-id="${escapeHtml(card.id)}"
                        type="button"
                    >
                        Excluir
                    </button>

                </div>

            </div>
        `;


        const deleteButton = article.querySelector('.delete-card');


        deleteButton.addEventListener('click', () => {
            deleteCard(card.id);
        });


        cardsGrid.appendChild(article);
    });
}


async function fetchCards() {

    cardsGrid.hidden = true;
    cardsError.hidden = true;


    try {

        const response = await fetch('/api/cards.php');
        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.error || 'Failed to fetch cards'
            );
        }

        const cards = Array.isArray(data) ? data : data.data;

        if (!Array.isArray(cards)) {
            throw new Error(
                'Invalid cards response'
            );
        }


        renderCards(cards);


        cardCount.textContent = `${cards.length} cards`;


    } catch (error) {

        console.error(error);

        cardsError.textContent = 'Unable to load cards. Please try again.';

        cardsError.hidden = false;

    } finally {
        cardsGrid.hidden = false;
    }
}


async function deleteCard(cardId) {
    const confirmed = confirm(
        'Are you sure you want to delete this card?'
    );

    if (!confirmed) {
        return;
    }

    try {
        const response =
            await fetch(
                `/api/cards.php?id=${encodeURIComponent(cardId)}`,
                {
                    method: 'DELETE'
                }
            );

        const data =
            await response.json();

        if (!response.ok) {
            throw new Error(
                data.error || 'Failed to delete card'
            );
        }

        await fetchCards();
    } 
    catch (error) {

        console.error(error);

        cardsError.textContent =
            'Unable to delete card. Please try again.';
        cardsError.hidden = false;
    }
}

logoutButton.addEventListener('click', async () => {
    
    
    const confirmed = confirm(
        'Are you sure you want to logout?'
    );

    if (!confirmed) {
        return;
    }

    logoutButton.disabled = true;

    try {
        const response = await fetch('/api/logout.php', {
            method: 'POST',
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error('Logout failed');
        }

        const data = await response.json();

        if (!data.authenticated) {
            window.location.href = '/login.php';
            return;
        }

        throw new Error('Logout failed');

    } catch (error) {
        console.error(error);
        logoutButton.disabled = false;
    }
});

fetchCards();
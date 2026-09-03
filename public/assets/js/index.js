const cardsGrid = document.querySelector('#cards-grid');
const cardsLoading = document.querySelector('#cards-loading');
const cardsError = document.querySelector('#cards-error');
const cardCount = document.querySelector('#card-count');


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

    cards.data.forEach(card => {
        const article = document.createElement('article');

        article.className = 'card';

        article.innerHTML = `
            <div class="card-image">
                ${
                    card.image
                        ? `<img src="${card.image}" alt="${(card.name_en)}">`
                        : `<div class="no-image">No image</div>`
                }
            </div>

            <div class="card-content">

                <h3>${(card.name_en)}</h3>

                ${
                    card.name_pt
                        ? `<p class="name-pt">
                            ${(card.name_pt)}
                           </p>`
                        : ''
                }

                <div class="card-details">

                    <span>
                        ${(card.card_game)}
                    </span>

                    <span>
                        ${(card.edition_name)}
                    </span>

                    <span>
                        ${(card.rarity)}
                    </span>

                </div>

                <div class="card-actions">

                    <a
                        href="/card-edit.php?id=${card.id}"
                        class="button"
                    >
                        Edit
                    </a>

                    <button
                        class="button button-danger"
                        data-delete="${card.id}"
                    >
                        Delete
                    </button>

                </div>

            </div>
        `;

        cardsGrid.appendChild(article);
    });
}

async function fetchCards() {
    cardsLoading.hidden = false;
    cardsGrid.hidden = true;
    cardsError.hidden = true;

    try {
        const response = await fetch('/api/cards.php');

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.error || 'Failed to fetch cards');
        }

        renderCards(data);

        cardCount.textContent = `${data.data.length} cards`;

    } catch (error) {
        console.error(error);

        cardsError.textContent =
            'Unable to load cards. Please try again.';

        cardsError.hidden = false;

    } finally {
        cardsLoading.hidden = true;
        cardsGrid.hidden = false;
    }
}

fetchCards();
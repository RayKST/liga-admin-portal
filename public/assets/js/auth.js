const form = document.querySelector('#login-form');
const errorMessage = document.querySelector('#error-message');

form.addEventListener('submit', async (event) => {
    event.preventDefault();

    errorMessage.textContent = '';

    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;

    try {
        const response = await fetch('/api/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email,
                password
            })
        });

        const data = await response.json();

        if (!response.ok) {
            errorMessage.textContent =
                data.error || 'Erro ao realizar login';

            return;
        }

        window.location.href = '/';

    } catch (error) {
        errorMessage.textContent =
            'Não foi possível conectar ao servidor.';
    }
});
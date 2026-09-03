<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Card Portal</title>

    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>

    <main>
        <form id="login-form">

            <h1>Card Portal</h1>

            <div>
                <label for="email">
                    E-mail
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                >
            </div>

            <div>
                <label for="password">
                    Senha
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                >
            </div>

            <p id="error-message"></p>

            <button type="submit">
                Entrar
            </button>

        </form>
    </main>

    <script src="/assets/js/auth.js"></script>

</body>
</html>
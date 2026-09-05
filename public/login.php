<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Card Portal</title>

    <link
        rel="stylesheet"
        href="/assets/css/global.css"
    >

    <link
        rel="stylesheet"
        href="/assets/css/login.css"
    >

</head>

<body>

    <main class="login-page">

        <form
            id="login-form"
            class="login-form"
        >

            <div class="login-header">

                <div class="logo-mark">
                    LM
                </div>

                <h1>
                    Card Portal
                </h1>

                <p>
                    Entre para gerenciar seus cards.
                </p>

            </div>


            <div class="form-group">

                <label for="email">
                    E-mail
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="seu@email.com"
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Senha
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Digite sua senha"
                >

            </div>


            <p
                id="error-message"
                class="error-message"
                role="alert"
            ></p>


            <button
                type="submit"
                class="button button-primary"
            >
                Entrar
            </button>

        </form>

    </main>


    <?php require __DIR__ . '/components/footer.php'; ?>


    <script src="/assets/js/auth.js"></script>

</body>

</html>
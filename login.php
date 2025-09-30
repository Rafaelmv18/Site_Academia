<?php include('config.php');
if (isset($_SESSION['erro_login'])) {
    echo "<script>alert('CPF e/ou senha errados!');</script>";
    unset($_SESSION['erro_login']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <a href="index.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo-section">
                <h1 class="logo-title">
                    <i class="fas fa-dumbbell"></i>
                    ACADEMIA
                </h1>
                <p class="subtitle">Entre na sua conta</p>
            </div>

            <form class="login-form" id="loginForm" action="login_processo.php" method="post">
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" id="cpf" name="cpf" placeholder="CPF">
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="senha" name="senha" placeholder="Senha">
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary" onclick="resetSection()">
                    <i class="fas fa-sign-in-alt"></i>
                    Entrar
                </button>

                <a href="pages_painel/esqueci_senha.php" class="forgot-password">Esqueci minha senha</a>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
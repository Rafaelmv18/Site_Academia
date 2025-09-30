<?php

require_once '../config.php';
$chaveSecreta = 'd$r78#Kx9!tW3zP_qRjE9yCvB2nMh0lQ&gY7oU4sA1zXc6vF5bN'; 
$iv = 'aB9fKx7s8JpL3mNq'; 

$token = $_GET['token'] ?? null;
$userId = null;
$isTokenValid = false;

if ($token) {
    try {
        $tokenDecodificado = base64_decode(urldecode($token));
        $dadosToken = openssl_decrypt($tokenDecodificado, 'aes-256-cbc', $chaveSecreta, 0, $iv);

        if ($dadosToken === false || empty($dadosToken)) {
            $isTokenValid = false;
        } else {
            list($userId, $expiracao) = explode('|', $dadosToken);
            
            if (time() > (int)$expiracao) {
                $isTokenValid = false;
            } elseif (!is_numeric($userId) || (int)$userId <= 0) {
                $isTokenValid = false;
            } else {
                $userId = (int)$userId;
                $isTokenValid = true;
            }
        }

    } catch (Exception $e) {
        $isTokenValid = false;
    }
} else {
    $isTokenValid = false; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $isTokenValid) {
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Se o token for válido, processa.
    if ($userId) { 
        if (empty($senha) || empty($confirmar_senha)) {
            $statusMessage = "ERRO: Os campos de senha não podem estar vazios.";
            $messageType = 'error';
        } elseif ($senha !== $confirmar_senha) {
            $statusMessage = "ERRO: As senhas digitadas não são iguais.";
            $messageType = 'error';
        } elseif (strlen($senha) < 6) { 
            $statusMessage = "ERRO: A senha deve ter no mínimo 6 caracteres.";
            $messageType = 'error';
        } else {
            try {
                $senhaTextoPuro = $senha; 

                $con = PgSql::conectar();
                $stmt = $con->prepare("UPDATE Usuario SET senha = ? WHERE usuario_id = ?");
                $success = $stmt->execute([$senhaTextoPuro, $userId]); 

                if ($success) {
                    echo "<script>
                        alert('SUCESSO: Sua senha foi redefinida com sucesso! Você pode fazer login agora.');
                        window.location.href = '../login.php'; 
                    </script>";
                    exit;
                } else {
                    $statusMessage = "ERRO: Falha ao atualizar a senha no banco de dados. Tente novamente.";
                    $messageType = 'error';
                }

            } catch (PDOException $pdoE) {
                $statusMessage = "ERRO DE BANCO DE DADOS: Não foi possível completar a redefinição.";
                $messageType = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha | Academia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>

    <style>
         .error-message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
        }
        .error-message.error {
            border: 1px solid #f00;
            color: #e62525ff;
        }
        .error-message.success {
            border: 1px solid #0a0;
            color: #008000;
        }
        .error-message a {
            color: #f39c12;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="logo-section">
                <h1 class="logo-title">
                    <i class="fas fa-dumbbell"></i>
                    ACADEMIA
                </h1>
                <p class="subtitle">Redefinir Senha</p>
            </div>
            <?php if ($isTokenValid): ?>
                <form class="login-form" method="post" action="redefinir_senha.php?token=<?php echo urlencode($token); ?>">
                    
                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="senha" name="senha" placeholder="Nova senha" required minlength="6">
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirmar nova senha" required minlength="6">
                            <button type="button"class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>


                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-check"></i>
                        Redefinir Senha
                    </button>
                </form>
            <?php else: ?>
                 <div class="error-message error">
                    ERRO: O link de redefinição é inválido ou expirou.
                    <p><a href="../login.php">Voltar para a página de Login</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>
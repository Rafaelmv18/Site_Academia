<?php
require_once 'config.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$chaveSecreta = 'd$r78#Kx9!tW3zP_qRjE9yCvB2nMh0lQ&gY7oU4sA1zXc6vF5bN'; 
$iv = 'aB9fKx7s8JpL3mNq'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);

    try {
        $emailCliente = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        if (empty($emailCliente) || !filter_var($emailCliente, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("email_invalido");
        }

        $con = PgSql::conectar();
        $stmt = $con->prepare("SELECT usuario_id, nome FROM Usuario WHERE email = ?");
        $stmt->execute([$emailCliente]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            throw new Exception("email_nao_encontrado");
        }
        $usuarioId = $usuario['usuario_id'];
        $nomeUsuario = $usuario['nome'];

        $expiracao = time() + (60 * 60); 
        $dadosToken = $usuarioId . '|' . $expiracao;

        $tokenCriptografado = openssl_encrypt($dadosToken, 'aes-256-cbc', $chaveSecreta, 0, $iv);
        $tokenCodificado = urlencode(base64_encode($tokenCriptografado));
        $link = INCLUDE_PATH . "pages_painel/redefinir_senha.php?token=" . $tokenCodificado;
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'spikegymbr@gmail.com'; 
        $mail->Password   = 'senha';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('spikegymbr@gmail.com', 'SPIKE GYM');
        $mail->addAddress($emailCliente, $nomeUsuario); 

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Redefinição de Senha - SPIKE GYM";

        // *** CORPO DO E-MAIL ***
        $mail->Body = "
            <html>
            <body style='font-family: Arial, sans-serif; color: #333;'>
                <div style='padding: 20px; border: 1px solid #ddd; border-radius: 8px; max-width: 600px; margin: auto;'>
                    <h2 style='color: #f39c12;'>Redefinição de Senha</h2>
                    <p>Olá, {$nomeUsuario},</p>
                    <p>Você solicitou a redefinição de senha da sua conta na <strong>SPIKE GYM</strong>. O link abaixo é válido por 1 hora.</p>
                    <p>Para continuar, clique no botão abaixo:</p>
                    <p style='text-align: center;'>
                        <a href='{$link}' style='display: inline-block; padding: 12px 20px; background-color: #f39c12; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>
                            Redefinir Senha
                        </a>
                    </p>
                    <br>
                    <p style='font-size: 14px; color: #555;'>Se você não solicitou, pode ignorar este e-mail.</p>
                </div>
            </body>
            </html>
        ";
        // *** CORPO ALTERNATIVO (TEXTO PLANO) ***
        $mail->AltBody = "Para redefinir sua senha na SPIKE GYM, use o seguinte link: {$link}";

        // ===================================================
        // 4. ENVIAR E-MAIL
        // ===================================================
        $mail->send();

        // SUCESSO: Exibe alerta e redireciona.
        $alert_message = "SUCESSO: Uma mensagem foi enviada para o e-mail: {$emailCliente} com as instruções para redefinição de senha.";
        
        echo "<script>
            alert('{$alert_message}');
            window.location.href = '" . INCLUDE_PATH . "login.php'; 
        </script>";
        exit;

    } catch (Exception $e) {
        
        $error_code = $e->getMessage();
        $message = '';

        if ($error_code === "email_invalido") {
            $message = "ERRO: O endereço de e-mail informado é inválido ou está vazio.";
        } 
        else if ($error_code === "email_nao_encontrado") {
             $message = "SUCESSO: As instruções de redefinição foram enviadas (se o endereço estiver cadastrado).";
        }
        else {
            $message = "FALHA: Erro ao enviar e-mail. Tente novamente mais tarde. (Detalhes técnicos: {$error_code})";
        }
        echo "<script>
            alert('{$message}');
            window.location.href = '../Site_Academia/login.php'; 
        </script>";
        exit;
    }
}
?>
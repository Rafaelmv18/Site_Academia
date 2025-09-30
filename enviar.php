<?php
// Usando namespaces para as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoloader do Composer. O caminho é relativo à localização deste arquivo.
require 'vendor/autoload.php';

// Garante que o script só seja acessado via método POST (envio de formulário)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Cria uma nova instância do PHPMailer. O `true` habilita o tratamento de exceções (erros).
    $mail = new PHPMailer(true);

    try {
        // ===================================================
        // PASSO 1: PEGAR E LIMPAR OS DADOS DO FORMULÁRIO
        // ===================================================
        $nomeCliente = htmlspecialchars($_POST['nome']);
        $emailCliente = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mensagemCliente = htmlspecialchars($_POST['mensagem']);

        // Validação simples para garantir que os campos não estão vazios
        if (empty($nomeCliente) || empty($emailCliente) || empty($mensagemCliente)) {
            throw new Exception("Por favor, preencha todos os campos.");
        }

        // ===================================================
        // PASSO 2: CONFIGURAÇÕES DO SERVIDOR DE E-MAIL (SMTP)
        // ===================================================
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Descomente para depuração detalhada
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';      // Servidor da Brevo
        $mail->SMTPAuth   = true;
        $mail->Username   = 'spikegymbr@gmail.com'; // E-mail que você usou para se cadastrar na Brevo
        $mail->Password   = '3J6wr0kCfAxMHbVT'; // A chave que a Brevo te deu
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Criptografia TLS
        $mail->Port       = 587;                 // Porta para SSL

        // ===================================================
        // PASSO 3: CONFIGURAÇÕES DA MENSAGEM
        // ===================================================
        // Quem envia o e-mail (deve ser o mesmo e-mail do Username)
        $mail->setFrom('spikegymbr@gmail.com', 'Site SPIKE GYM');
        // Para quem o e-mail será enviado (o e-mail da sua academia)
        $mail->addAddress('email.da.sua.academia@exemplo.com', 'Recepção SPIKE GYM');

        // Configura o "Responder Para". Essencial para responder ao cliente.
        $mail->addReplyTo($emailCliente, $nomeCliente);
        
        // Configurações de conteúdo
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Nova Mensagem do Site de: ' . $nomeCliente;

        // Corpo do e-mail em HTML
        $mail->Body = "
            <html>
            <body style='font-family: Arial, sans-serif; color: #333;'>
                <div style='padding: 20px; border: 1px solid #ddd; border-radius: 8px; max-width: 600px; margin: auto;'>
                    <h2 style='color: #f39c12;'>Nova Mensagem Recebida do Site</h2>
                    <p style='line-height: 1.6;'>Você recebeu uma nova mensagem através do formulário de contato.</p>
                    <hr>
                    <p><strong>Nome:</strong> {$nomeCliente}</p>
                    <p><strong>E-mail:</strong> {$emailCliente}</p>
                    <h3 style='margin-top: 20px;'>Mensagem:</h3>
                    <p style='background-color: #f9f9f9; padding: 15px; border-radius: 5px;'>" 
                        . nl2br($mensagemCliente) . "
                    </p>
                </div>
            </body>
            </html>
        ";
        
        // Corpo alternativo em texto puro para clientes de e-mail que não suportam HTML
        $mail->AltBody = "Nome: {$nomeCliente}\nE-mail: {$emailCliente}\n\nMensagem:\n{$mensagemCliente}";
        
        // ===================================================
        // PASSO 4: ENVIAR O E-MAIL E DAR FEEDBACK
        // ===================================================
        $mail->send();
        echo "<script>
                alert('Mensagem enviada com sucesso! Agradecemos o seu contato.');
                window.location.href = 'index.php?url=contato';
              </script>";

    } catch (Exception $e) {
        // Se ocorrer um erro, exibe uma mensagem e o erro detalhado
        // Em um site em produção, você poderia registrar o erro em um log em vez de mostrá-lo ao usuário.
        echo "<script>
                alert('A mensagem não pôde ser enviada. Por favor, tente novamente mais tarde. Detalhe do erro: {$mail->ErrorInfo}');
                window.location.href = 'index.php?url=contato';
              </script>";
    }

} else {
    // Se alguém tentar acessar o arquivo diretamente pelo navegador, redireciona.
    header("Location: index.php");
    exit();
}
?>
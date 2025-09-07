<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/contato.css">
</head>
<body>
    <section class="contato">
        <h2>Entre em Contato</h2>
        <form action="enviar.php" method="POST" class="form-contato">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="email" name="email" placeholder="Seu e-mail" required>
            <textarea name="mensagem" placeholder="Sua mensagem" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>
</body>
</html>
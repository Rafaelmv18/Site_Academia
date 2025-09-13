<?php
$plano = isset($_GET['plano']) ? $_GET['plano'] : 'Plano não definido';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '0,00';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagamento</title>
  <link rel="stylesheet" href="style_painel/pagamento.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../style_painel/pagamento.css">
</head>
<body>
    <section class="pagamento-wrapper">
        <h2>Finalizar Pagamento</h2>

        <!-- Resumo do plano -->
        <div class="resumo-plano">
            <h3><?php echo htmlspecialchars($plano); ?></h3>
            <p class="preco">R$ <?php echo htmlspecialchars($valor); ?>/mês</p>
        </div>

        <!-- Formulário de pagamento -->
        <form class="form-pagamento">
            <h3>Dados do Cartão</h3>

            <div class="form-group">
            <label for="nome">Nome no Cartão</label>
            <input type="text" id="nome" placeholder="Ex: João da Silva" required>
            </div>

            <div class="form-group">
            <label for="numero">Número do Cartão</label>
            <input type="text" id="numero" placeholder="0000 0000 0000 0000" maxlength="19" required>
            </div>

            <div class="form-row">
            <div class="form-group">
                <label for="validade">Validade</label>
                <input type="text" id="validade" placeholder="MM/AA" maxlength="5" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" placeholder="123" maxlength="3" required>
            </div>
            </div>

            <div class="botoes-pagamento">
                <button type="button" class="btn-cancelar" onclick="window.location.href='../painel.php?section=planos'">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </button>
                <button type="submit" class="btn-finalizar">
                    <i class="fa-solid fa-lock"></i> Pagar Agora
                </button>
            </div>
        </form>
    </section>
</body>
</html>

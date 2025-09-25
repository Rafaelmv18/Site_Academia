<?php
    include('../config.php');
    $plano = Painel::select('plano', 'plano_id=?', array($_GET['plano_id']));

    
if (isset($_POST['finalizar-pagamento'])) {
    $plano_id = $_POST['plano_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Busca o aluno pelo usuário logado
    $aluno = Painel::select('aluno', 'aluno_id=?', array($usuario_id));
    $aluno_id = $aluno['aluno_id'];

    // Dados do plano
    $plano = Painel::select('plano', 'plano_id=?', array($plano_id));
    $valor = $plano['valor'];
    $nome_plano = $plano['nome'];

    // Datas
    $data_inicio = date('Y-m-d');
    $data_fim = date('Y-m-d', strtotime('+1 month', strtotime($data_inicio)));

    // Pagamento
    $forma_pagamento = "cartão"; 
    $data_pagamento = date('Y-m-d');
    $status = "aprovado";

    Pagamento::cadastrarPagamento($aluno_id, $valor, $forma_pagamento, $data_pagamento, $status);
    Aluno::atualizarAluno($plano_id, $data_inicio, $data_fim, $aluno_id);
    header('Location: ../painel.php?section=inicio');
}

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
            <h3><?php echo $plano['nome'] ?></h3>
            <p class="preco">R$ <?php echo $plano['valor']; ?>/mês</p>
        </div>

        <!-- Formulário de pagamento -->
        <form class="form-pagamento" method="POST">
            <input type="hidden" name="plano_id" value="<?php echo htmlspecialchars($_GET['plano_id']); ?>">
            <h3>Dados do Cartão</h3>

            <div class="form-group">
            <label for="nome">Nome no Cartão</label>
            <input type="text" name="nome" id="nome" placeholder="Ex: João da Silva" required>
            </div>

            <div class="form-group">
            <label for="numero">Número do Cartão</label>
            <input type="text" name="numero"  id="numero" placeholder="0000 0000 0000 0000" maxlength="19" required>
            </div>

            <div class="form-row">
            <div class="form-group">
                <label for="validade">Validade</label>
                <input type="text" name="validade" id="validade" placeholder="MM/AA" maxlength="5" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" name="cvv" id="cvv" placeholder="123" maxlength="3" required>
            </div>
            </div>

            <div class="botoes-pagamento">
                <button type="button" class="btn-cancelar" onclick="window.location.href='../painel.php?section=planos'">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </button>
                <button type="submit" class="btn-finalizar" name="finalizar-pagamento">
                    <i class="fa-solid fa-lock"></i> Pagar Agora
                </button>
            </div>
        </form>
    </section>
</body>
</html>

<?php
    $plano = isset($_GET['plano']) ? $_GET['plano'] : 'Plano não definido';
    $valor = isset($_GET['valor']) ? $_GET['valor'] : '0,00';
?>

<section class="pagamento-wrapper">
    <h2>Finalizar Pagamento</h2>

    <!-- Resumo do plano -->
    <div class="resumo-plano">
        <h3>Plano Premium</h3>
        <p class="preco">R$ 59,90/mês</p>
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

        <button type="submit" class="btn-finalizar">
            <i class="fa-solid fa-lock"></i> Pagar Agora
        </button>
    </form>

    <!-- Outras formas de pagamento -->
    <div class="outras-opcoes">
        <p>Ou escolha outra forma de pagamento:</p>
        <div class="botoes-extra">
            <button class="btn-extra"><i class="fa-brands fa-pix"></i> PIX</button>
            <button class="btn-extra"><i class="fa-solid fa-barcode"></i> Boleto</button>
        </div>
    </div>
</section>
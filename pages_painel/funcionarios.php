<section>
    <div class="usuarios-wrapper">
        <h2>Buscar funcionário por CPF</h2>

        <!-- Pesquisa -->
        <div class="search-box-usuario">
            <input id="cpfInput" type="text" placeholder="Digite o CPF (apenas números)" maxlength="14" />
        <button id="searchBtn" class="btn-primary">Buscar</button>
        </div>

        <!-- Resultado -->
        <div id="resultArea" class="result-area" aria-live="polite">
            <div class="user-card">
                <i class="fa-solid fa-user-circle user-icon"></i>
                <span class="user-name">João Silva</span>
                <span class="user-cpf">123.456.789-00</span>
                <span class="user-plan">Instrutor</span>
            </div>
        </div>
    </div>
</section>
<?php
require('../config.php');
?>
    <section>
    <div class="usuarios-wrapper">
        <h2>Cadastro de Usuário</h2>
        <form class="cadastro-form" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required />
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" maxlength="14" required />
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <div class="telefone-box">
                    <select id="ddi" name="ddi">
                        <option value="+55" selected>+55</option>
                    </select>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required />
                </div>
            </div>

            <div class="form-group">
                <label for="nascimento">Data de Nascimento</label>
                <input type="date" id="nascimento" name="nascimento" required />
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea id="endereco" name="endereco" placeholder="Digite seu endereço completo" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo">
                    <option value="0">Aluno</option>
                    <option value="1">Funcionário</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo</label>
                <select id="cargo" name="cargo">
                    <option value="0">Normal</option>
                    <option value="1">Admin</option>
                </select>
            </div>

            <!-- Botão -->
            <button type="submit" name="cadastro" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    </section>

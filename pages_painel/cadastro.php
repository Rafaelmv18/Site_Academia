<?php
require('../config.php');
?>
    <section>
        <div class="usuarios-wrapper">
            <h2>Cadastro de Usuário</h2>

            <!-- Formulário de Cadastro -->
            <form class="cadastro-form">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" placeholder="Digite seu nome" required />
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" placeholder="Digite seu e-mail" required />
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" placeholder="Digite seu CPF" maxlength="14" required />
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <div class="telefone-box">
                        <select id="ddi">
                            <option value="+55" selected>+55</option>
                        </select>
                        <input type="tel" id="telefone" placeholder="(00) 00000-0000" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="nascimento">Data de Nascimento</label>
                    <input type="date" id="nascimento" required />
                </div>

                <div class="form-group">
                    <label for="genero">Gênero</label>
                    <select id="genero">
                        <option value="">Selecione</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <!-- Botão -->
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </section>

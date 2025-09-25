-- ================================
-- TABELAS
-- ================================

-- 1. Usuário
CREATE TABLE Usuario (
    usuario_id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    CPF VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20),
    data_nascimento DATE,
    endereco TEXT,
    tipo_usuario int, -- 0 = aluno, 1 = funcionário, 2 = Recepcionista, 3= Gerente, 4 = Outro
    cargo SMALLINT CHECK (cargo IN (0, 1)), -- 0 = normal, 1 = admin
    status VARCHAR(10) DEFAULT 'ativo'
);


-- 4. Plano (precisa existir antes de Aluno)
CREATE TABLE Plano (
    plano_id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    valor DECIMAL(10,2) NOT NULL
);

-- 2. Aluno (extensão de Usuário)
CREATE TABLE Aluno (
    aluno_id INT PRIMARY KEY REFERENCES Usuario(usuario_id) ON DELETE CASCADE,
    plano_id INT REFERENCES Plano(plano_id),
    data_inicio_plano DATE,
    data_fim_plano DATE
);

-- 3. Funcionário (extensão de Usuário)
CREATE TABLE Funcionario (
    funcionario_id INT PRIMARY KEY REFERENCES Usuario(usuario_id) ON DELETE CASCADE,
    cargo VARCHAR(50) NOT NULL
);

-- 5. Pagamento
CREATE TABLE Pagamento (
    pagamento_id SERIAL PRIMARY KEY,
    aluno_id INT REFERENCES Aluno(aluno_id) ON DELETE CASCADE,
    valor DECIMAL(10,2) NOT NULL,
    forma_pagamento VARCHAR(20) CHECK (forma_pagamento IN ('cartão', 'boleto', 'pix', 'dinheiro')),
    data_pagamento DATE NOT NULL,
    status VARCHAR(20) DEFAULT 'pendente'
);

-- 6. Modalidade
CREATE TABLE Modalidade (
    modalidade_id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    horarios JSONB,
    imagem VARCHAR(255)
);

-- 7. Entrada (Controle de Acesso)
CREATE TABLE Entrada (
    entrada_id SERIAL PRIMARY KEY,
    aluno_id INT REFERENCES Aluno(aluno_id) ON DELETE CASCADE,
    data_hora_entrada TIMESTAMP NOT NULL,
    data_hora_saida TIMESTAMP
);

-- 8. Agendamentos (Modalidades)
CREATE TABLE Agendamento (
    agendamento_id SERIAL PRIMARY KEY,
    modalidade_id INT REFERENCES Modalidade(modalidade_id) ON DELETE CASCADE,
    aluno_id INT REFERENCES Aluno(aluno_id) ON DELETE CASCADE,
    data TIMESTAMP NOT NULL
);

-- ================================
-- INSERÇÃO DE DADOS
-- ================================

-- Aluno
INSERT INTO Usuario (nome, senha, CPF, email, telefone, data_nascimento, endereco, tipo_usuario, cargo)
VALUES ('João Silva', '123456', '123.456.789-00', 'joao@email.com', '11999999999', '1995-05-10', 'Rua A, 123', 0, 0);
-- Funcionário
INSERT INTO Usuario (nome, senha, CPF, email, telefone, data_nascimento, endereco, tipo_usuario, cargo)
VALUES ('Carlos Pereira', 'senha123', '321.654.987-00', 'carlos@email.com', '11911112222', '2000-07-22', 'Av. das Flores, 789', 2,0);

-- Funcionário
INSERT INTO Usuario (nome, senha, CPF, email, telefone, data_nascimento, endereco, tipo_usuario, cargo)
VALUES ('Maria Souza', '654321', '987.654.321-00', 'maria@email.com', '11888888888', '1988-03-15', 'Rua B, 456', 1, 1);
-- Aluno
INSERT INTO Usuario (nome, senha, CPF, email, telefone, data_nascimento, endereco, tipo_usuario, cargo)
VALUES ('Ana Oliveira', 'senha456', '654.987.321-11', 'ana@email.com', '11777776666', '1992-11-05', 'Rua Central, 101', 0, 1);

-- Plano
INSERT INTO Plano (nome, descricao, valor, detalhes)
VALUES ('Plano Básico', 'Plano Básico', 79.90, '{"aulas": "musculação, funcional"}');

INSERT INTO Plano (nome, descricao, valor, detalhes)
VALUES ('Anual Plano Plus', 'Anual Plano Plus', 109.90, '{"aulas": "todas", "personal": true}');

INSERT INTO Plano (nome, descricao, valor, detalhes)
VALUES ('Anual Premium', 'Anual Plano Plus', 159.90, '{"aulas": "todas", "personal": true}');

UPDATE Aluno
SET plano_id = 1, data_inicio_plano = CURRENT_DATE, data_fim_plano = CURRENT_DATE + INTERVAL '30 days'
WHERE aluno_id = 1;

-- Pagamento pendente
INSERT INTO Pagamento (aluno_id, valor, forma_pagamento, data_pagamento, status)
VALUES (1, 120.00, 'pix', CURRENT_DATE, 'pendente');

-- Pagamento pago
INSERT INTO Pagamento (aluno_id, valor, forma_pagamento, data_pagamento, status)
VALUES (4, 120.00, 'cartão', CURRENT_DATE, 'pago');

INSERT INTO Modalidade (nome, descricao, horarios, imagem)
VALUES ('Musculação', 'Treino de força e resistência', 'Seg-Sex: 06h-22h', 'musculacao.jpg');

INSERT INTO Modalidade (nome, descricao, horarios, imagem)
VALUES ('Crossfit', 'Alta intensidade', 'Seg-Sáb: 07h-20h', 'crossfit.jpg');

INSERT INTO Entrada (aluno_id, data_hora_entrada)
VALUES (1, NOW());

INSERT INTO Entrada (aluno_id, data_hora_entrada)
VALUES (4, NOW());

-- Quando sair:
UPDATE Entrada
SET data_hora_saida = NOW()
WHERE entrada_id = 1;

UPDATE Entrada
SET data_hora_saida = NOW()
WHERE entrada_id = 4;

INSERT INTO Agendamento (modalidade_id, aluno_id, data)
VALUES (2, 1, '2025-09-25 18:00:00');

INSERT INTO Agendamento (modalidade_id, aluno_id, data) 
VALUES (1, 4, '2025-10-22 07:00:00');

-- Deletar agendamento
DELETE FROM Agendamento WHERE agendamento_id = 1;

-- Deletar entrada
DELETE FROM Entrada WHERE entrada_id = 1;

-- Deletar pagamento (vai registrar na auditoria)
DELETE FROM Pagamento WHERE pagamento_id = 2;

-- Deletar aluno (vai remover em cascata os pagamentos e entradas dele)
DELETE FROM Usuario WHERE usuario_id = 1;


-- ================================
-- TRIGGER DE AUDITORIA
-- ================================

CREATE OR REPLACE FUNCTION funcionario_aluno()
RETURNS TRIGGER AS $$
DECLARE
    cargo_texto TEXT;
BEGIN
    -- Se tipo_usuario é 0, insere na tabela Aluno
    IF NEW.tipo_usuario = 0 THEN
        INSERT INTO aluno (aluno_id)
        VALUES (NEW.usuario_id)
        ON CONFLICT (aluno_id) DO NOTHING;

    -- Se for qualquer outro tipo, é um funcionário
    ELSIF NEW.tipo_usuario > 0 THEN
        IF NEW.tipo_usuario = 1 THEN
            cargo_texto := 'Professor';
        ELSIF NEW.tipo_usuario = 2 THEN
            cargo_texto := 'Recepcionista';
        ELSIF NEW.tipo_usuario = 3 THEN
            cargo_texto := 'Gerente';
        ELSIF NEW.tipo_usuario = 4 THEN
            cargo_texto := 'Zelador';
        ELSE
            cargo_texto := 'Outro';
        END IF;

        INSERT INTO funcionario (funcionario_id, cargo)
        VALUES (NEW.usuario_id, cargo_texto)
        ON CONFLICT (funcionario_id) DO NOTHING;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_funcionario_aluno
AFTER INSERT ON Usuario
FOR EACH ROW EXECUTE FUNCTION funcionario_aluno();

-- ================================
-- FUNCTION DE REGRA DE NEGÓCIO
-- ================================
CREATE OR REPLACE FUNCTION verificar_plano_ativo(p_aluno_id INT)
RETURNS BOOLEAN AS $$
DECLARE
    fim DATE;
BEGIN
    SELECT data_fim_plano INTO fim
    FROM Aluno
    WHERE aluno_id = p_aluno_id;

    IF fim IS NULL OR fim >= CURRENT_DATE THEN
        RETURN TRUE; -- Plano ativo
    ELSE
        RETURN FALSE; -- Plano expirado
    END IF;
END;
$$ LANGUAGE plpgsql;


-- ================================
-- VIEW PARA RELATÓRIO
-- ================================

CREATE OR REPLACE VIEW vw_entradas_mes AS
SELECT 
    u.nome AS nome_aluno,
    u.CPF, -- Adicionamos a nova coluna aqui
    e.data_hora_entrada,
    e.data_hora_saida,
    (e.data_hora_saida - e.data_hora_entrada) AS duracao
FROM 
    Entrada AS e
JOIN 
    Aluno AS a ON e.aluno_id = a.aluno_id
JOIN 
    Usuario AS u ON a.aluno_id = u.usuario_id
WHERE 
    DATE_TRUNC('month', e.data_hora_entrada) = DATE_TRUNC('month', NOW())
ORDER BY 
    e.data_hora_entrada DESC;


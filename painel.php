<?php
require_once('./config.php');
$tipo_conta = ($_SESSION['tipo_usuario'] == 1) ? 'Administrador' : 'Usuário';

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['cpf'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $ddi = $_POST['ddi'];
    $telefone = $ddi . ' ' . $_POST['telefone'];
    $data   = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $tipo = $_POST['tipo'];
    $cargo = $_POST['cargo'];

    Usuario::cadastrarUsuario($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo);
}

if (isset($_POST['atualiza'])) {
    $atualizado = Usuario::atualizarUsuario(
        $_SESSION['usuario_id'],
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['email'],
        $_POST['telefone'],
        $_POST['nascimento'],
        $_POST['endereco']
    );
}

// Define o diretório de destino para as imagens
$uploadDir = 'img/';

// --- CADASTRAR NOVA MODALIDADE ---
if (isset($_POST['cadastrarModalidade'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $horario_dia = $_POST['horario_dia'] ?? '';
    $horario_inicio = $_POST['horario_inicio'] ?? '';
    $horario_fim = $_POST['horario_fim'] ?? '';
    $horariosArray = [['dia' => $horario_dia, 'inicio' => $horario_inicio, 'fim' => $horario_fim]];
    $horariosJson = json_encode($horariosArray);
    $imagemPath = ''; // Valor padrão

    // Verifica se uma imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $nomeArquivo = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $caminhoCompleto = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
            $imagemPath = $caminhoCompleto; // Salva o caminho completo (ex: 'img/arquivo.jpg')
        }
    }

    Modalidade::cadastrarModalidade($nome, $descricao, $horariosJson, $imagemPath);
    // Sugestão: Adicionar alerta e redirect aqui.
}

// --- ATUALIZAR MODALIDADE EXISTENTE ---
if (isset($_POST['atualizarModalidade'])) {
    $id = $_POST['modalidade_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $imagemPath = $_POST['imagem_atual'];

    // 1. Pega os dados dos campos de horário individuais
    $dia = $_POST['horario_dia'] ?? '';
    $inicio = $_POST['horario_inicio'] ?? '';
    $fim = $_POST['horario_fim'] ?? '';

    // 2. Monta um array PHP com a estrutura do JSON
    $horarioParaSalvar = [
        [
            'dia' => $dia,
            'inicio' => $inicio,
            'fim' => $fim
        ]
    ];
    // 3. Converte o array PHP para uma string JSON
    $horariosJsonParaSalvar = json_encode($horarioParaSalvar);

    // Verifica se uma NOVA imagem foi enviada para substituir a antiga
    if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0) {
        $nomeArquivo = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $caminhoCompleto = $uploadDir . $nomeArquivo;

        // Tenta mover o novo arquivo
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
            // Se conseguiu mover o novo, apaga o antigo (se existir)
            if (!empty($imagemPath) && file_exists($imagemPath)) {
                unlink($imagemPath);
            }
            // Atualiza o caminho da imagem para o novo arquivo
            $imagemPath = $caminhoCompleto;
        }
    }

    Modalidade::atualizarModalidade($id, $nome, $descricao, $horariosJsonParaSalvar, $imagemPath);
    // Sugestão: Adicionar alerta e redirect aqui.
}

// --- EXCLUIR MODALIDADE ---
if (isset($_POST['excluirModalidade'])) {
    $id = $_POST['modalidade_id'];
    // Pega o caminho da imagem atual para poder excluí-la do servidor
    $imagemPath = $_POST['imagem_atual'];

    // Apaga o arquivo de imagem do servidor, se ele existir
    if (!empty($imagemPath) && file_exists($imagemPath)) {
        unlink($imagemPath);
    }

    Modalidade::deletarModalidade($id);
    // Sugestão: Adicionar alerta e redirect aqui.
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPIKE GYM</title>
    <link rel="stylesheet" href="style_painel/painel.css">

    <link rel="stylesheet" href="style_painel/inicio.css">
    <link rel="stylesheet" href="style_painel/planos.css">
    <link rel="stylesheet" href="style_painel/agendamento.css">
    <link rel="stylesheet" href="style_painel/cadastro.css">
    <link rel="stylesheet" href="style_painel/usuarios_funcionarios.css">
    <link rel="stylesheet" href="style_painel/modalidades.css">
    <link rel="stylesheet" href="style_painel/relatorio.css">
    


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>

    <script src="./js/jquery.js"></script>
    <script src="./js/modalidade.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Menu Lateral -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-chart-line"></i>
                    <span>Área do Cliente</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="inicio" class="nav-link" data-section="inicio">
                            <i class="fa-solid fa-house"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="planos" class="nav-link" data-section="planos">
                            <i class="fa-solid fa-calendar"></i>
                            <span>Planos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="agendamentos" class="nav-link" data-section="agendamentos">
                            <i class="fa-solid fa-table"></i>
                            <span>Agendamentos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dados" class="nav-link" data-section="dados">
                            <i class="fa-solid fa-user"></i>
                            <span>Dados</span>
                        </a>
                    </li>
                    <li class="nav-item" <?php echo ($_SESSION['tipo_usuario'] < 1 ? 'hidden' : ''); ?>>
                        <a href="cadastro" class="nav-link" data-section="cadastro">
                            <i class="fa-solid fa-users-between-lines"></i>
                            <span>Cadastro</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['tipo_usuario'] < 1 ? 'hidden' : ''); ?>">
                        <a href="usuarios" class="nav-link" data-section="usuarios">
                            <i class="fas fa-users"></i>
                            <span>Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['tipo_usuario'] < 1 ? 'hidden' : ''); ?>">
                        <a href="modalidades" class="nav-link" data-section="modalidades">
                            <i class="fa-solid fa-file"></i>
                            <span>Modalidades</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['tipo_usuario'] < 1 ? 'hidden' : ''); ?>">
                        <a href="relatorio" class="nav-link" data-section="relatorio">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span>Relatorio</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
                        <span class="user-role"><?php echo $tipo_conta; ?></span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Área Principal -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="top-bar-left">
                    <button class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Dashboard</h1>
                </div>
                
                <div class="top-bar-right">
                    <div class="user-menu">
                        <button class="user-btn">
                            <div class="user-avatar-small">
                                <i class="fas fa-user"></i>
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="sub_menu">
                            <li><a href="index.php">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <div class="content-area">
                
            </div>
        </main>
    </div>

    <script src="./js/dashboard.js"></script>
</body>
</html>
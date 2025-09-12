<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="style_painel/painel.css">

    <link rel="stylesheet" href="style_painel/inicio.css">
    <link rel="stylesheet" href="style_painel/planos.css">
    <link rel="stylesheet" href="style_painel/agendamento.css">
    <link rel="stylesheet" href="style_painel/cadastro.css">
    <link rel="stylesheet" href="style_painel/usuarios_funcionarios.css">
    


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>
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
                    <li class="nav-item active">
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
                        <a href="cadastro" class="nav-link" data-section="cadastro">
                            <i class="fa-solid fa-users-between-lines"></i>
                            <span>Cadastro</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link" data-section="usuarios">
                            <i class="fas fa-users"></i>
                            <span>Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="funcionarios" class="nav-link" data-section="funcionarios">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>Funcionários</span>
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
                        <span class="user-name">Admin</span>
                        <span class="user-role">Administrador</span>
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
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Pesquisar...">
                    </div>
                    
                    <div class="notifications">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <div class="user-menu">
                        <button class="user-btn">
                            <div class="user-avatar-small">
                                <i class="fas fa-user"></i>
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="sub_menu">
                            <li><a href="login.php">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <div class="content-area">
                
            </div>
        </main>
    </div>

    <script src="js/dashboard.js"></script>
</body>
</html>
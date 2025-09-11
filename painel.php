<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="style/painel.css">
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
                        <a href="#dashboard" class="nav-link" data-section="dashboard">
                            <i class="fas fa-users"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#usuarios" class="nav-link" data-section="usuarios">
                            <i class="fas fa-users"></i>
                            <span>Planos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#relatorios" class="nav-link" data-section="relatorios">
                            <i class="fas fa-users"></i>
                            <span>Agendamentos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#vendas" class="nav-link" data-section="vendas">
                            <i class="fas fa-users"></i>
                            <span>Cadastro</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#produtos" class="nav-link" data-section="produtos">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#configuracoes" class="nav-link" data-section="configuracoes">
                            <i class="fas fa-users"></i>
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
                    </div>
                </div>
            </header>

            <div class="content-area">
                <!-- Dashboard Section -->
                <section id="dashboard" class="content-section active">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3>1,234</h3>
                                <p>Usuários Ativos</p>
                                <span class="stat-change positive">+12%</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-content">
                                <h3>R$ 45,678</h3>
                                <p>Vendas do Mês</p>
                                <span class="stat-change positive">+8%</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-content">
                                <h3>89.5%</h3>
                                <p>Taxa de Conversão</p>
                                <span class="stat-change negative">-2%</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stat-content">
                                <h3>567</h3>
                                <p>Produtos</p>
                                <span class="stat-change positive">+15</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
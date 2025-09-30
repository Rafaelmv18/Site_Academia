<?php 
// Usar require_once é a melhor prática para arquivos de configuração.
require_once('config.php'); 

// Torna a variável $supabase acessível.
global $supabase;

// Busca as modalidades usando a API.
// Atenção: O nome da tabela deve ser EXATAMENTE como está no Supabase (geralmente com letra maiúscula).
$modalidadesParaMenu = $supabase->selectAll('Modalidade', 'nome', 'asc');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPIKE GYM</title>
        <link rel="stylesheet" href="style/home.css">
        <script src="js/jquery.js"></script>
        <script src="js/home.js"></script>
    </head>
    <body>
    <?php
        $url = $_GET['url'] ?? 'planos';
        $pagina = $url;
    ?>
    <header>
        <div class="center">
            <div class="logo"><a href="?url=planos">SPIKE GYM</a></div>
            <nav>
                <ul>
                    <li><a href="?url=sobre" class="<?= $pagina == 'sobre' ? 'active' : '' ?>">Sobre Nós</a></li>
                    <li><a href="?url=planos" class="<?= $pagina == 'planos' ? 'active' : '' ?>">Planos</a></li>
                    <li>
                        <a href="?url=modalidades" class="<?= $pagina == 'modalidades' ? 'active' : '' ?>">Modalidades</a>
                        <ul class="sub_menu">
                            <?php 
                            if (isset($modalidadesParaMenu) && !isset($modalidadesParaMenu['error'])) {
                                foreach ($modalidadesParaMenu as $modalidade){ 
                                    $slug = strtolower(str_replace(' ', '-', $modalidade['nome']));
                                ?>
                                    <li><a href="?url=modalidades#modalidade-<?php echo $slug; ?>"><?php echo htmlspecialchars($modalidade['nome']); ?></a></li>
                                <?php 
                                } 
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="?url=contato" class="<?= $pagina == 'contato' ? 'active' : '' ?>">Contato</a></li>
                    <li class="areaCliente"><a href="login.php">Área do Cliente</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php
            $page_path = "pages/" . $url . ".php";
            if (file_exists($page_path)) {
                include($page_path);
            } else {
                include("pages/404.php");
            }
        ?>
    </main>

    <footer>
        </footer>

</body>
</html>
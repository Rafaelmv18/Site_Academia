<?php 
// 1. Inclui o config.php. Ele já inicia a sessão e cria a variável global $supabase.
include('config.php'); 

// 2. Torna a variável $supabase acessível neste escopo.
global $supabase;

// 3. Usa o método 'select' da classe SupabaseAPI para buscar as modalidades.
//    O resultado já vem como um array PHP.
$modalidadesParaMenu = $supabase->select('Modalidade', 'select=nome&order=nome.asc');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPIKE GYM</title>
        <link rel="stylesheet" href="style/home.css">
        <link rel="stylesheet" href="style/sobre.css">
        <link rel="stylesheet" href="style/planos.css">
        <link rel="stylesheet" href="style/modalidades.css">
        <link rel="stylesheet" href="style/contato.css">
        <script src="js/jquery.js"></script>
        <script src="js/home.js"></script>
    </head>
    <body>
    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'planos';
        $pagina = $_GET['url'] ?? 'planos'; 
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
                            // 4. O loop para gerar o menu continua igual, mas agora usa os dados da API.
                            // Verifica se a busca na API retornou dados e não um erro.
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
                    <li class="areaCliente"><a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '' ?>">Área do Cliente</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php
            // A lógica de inclusão de páginas continua exatamente a mesma.
            if (file_exists("pages/" . $url . ".php")) {
                include("pages/" . $url . ".php");
            } else {
                include("pages/404.php");
            }
        ?>
    </main>

    <footer>
        </footer>

</body>
</html>
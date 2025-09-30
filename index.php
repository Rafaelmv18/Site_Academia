<?php 
include('config.php'); 
$modalidadesParaMenu = Painel::selectAll('modalidade', 'nome', 'ASC');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPIKE GYM</title>
        <link rel="stylesheet" href="style/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>
        
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
            <div class="logo"><a href="?url=planos">SPIKE GYM</a></div><!--logo-->
            <nav>
                <ul>
                    <li><a href="?url=sobre" class="<?= $pagina == 'sobre' ? 'active' : '' ?>">Sobre Nós</a></li>
                    <li><a href="?url=planos" class="<?= $pagina == 'planos' ? 'active' : '' ?>">Planos</a></li>
                    <li>
                        <a href="?url=modalidades" class="<?= $pagina == 'modalidades' ? 'active' : '' ?>">Modalidades</a>
                        <ul class="sub_menu">
                            <?php 
                            // Agrupa as modalidades para não repetir nomes
                            $agrupadas = [];
                            foreach ($modalidadesParaMenu as $modalidade) {
                                $nome = $modalidade['nome'];
                                if (!isset($agrupadas[$nome])) {
                                    $agrupadas[$nome] = $modalidade; // guarda apenas o primeiro encontrado
                                }
                            }

                            // Agora percorre apenas os nomes únicos
                            foreach ($agrupadas as $modalidade){ 
                                $slug = strtolower(str_replace(' ', '-', $modalidade['nome']));
                            ?>
                                <li><a href="?url=modalidades#modalidade-<?php echo $slug; ?>"><?php echo $modalidade['nome']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="?url=contato" class="<?= $pagina == 'contato' ? 'active' : '' ?>">Contato</a></li>
                    <li class="areaCliente"><a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '' ?>">Área do Cliente</a></li>
                </ul>
            </nav>
        </div><!--center-->
    </header>

    <main>
        <?php
            if (!isset($url) || $url == "") {
                $url = "planos";
            }

            if (file_exists("pages/" . $url . ".php")) {
                include("pages/" . $url . ".php");
            } else {
                include("pages/404.php");
            }
        ?>
        
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-info">
                <h3>SPIKE GYM</h3>
                <p>Rua Exemplo, 123 - Cidade/UF</p>
                <p><i class="fa-solid fa-phone"></i> (99) 99999-9999</p>
                <p><i class="fa-regular fa-envelope"></i> spikegym@academia.com</p>
            </div><!--footer-info-->

            <div class="footer-links">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="?=sobre">Sobre Nós</a></li>
                    <li><a href="?url=modalidades">Modalidades</a></li>
                    <li><a href="?url=contato">Contato</a></li>
                </ul>
            </div><!--footer-links-->

            <div class="footer-social">
                <h4>Siga-nos</h4>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>  
            </div><!--footer-social-->
        </div><!--footer-container-->
        <p class="footer-copy">© 2025 SPIKE GYM. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
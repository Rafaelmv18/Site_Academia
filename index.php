<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="./style/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/svg+xml" 
      href='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="%23FFD43B"><path d="M104 96h24V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h256V64c0-17.7 14.3-32 32-32s32 14.3 32 32v32h24c13.3 0 24 10.7 24 24v272c0 13.3-10.7 24-24 24h-24v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H104c-13.3 0-24-10.7-24-24V120c0-13.3 10.7-24 24-24z"/></svg>'>


</head>
<body>
    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'planos';
    ?>
    <header>
        <div class="center">
            <div class="logo"><a href="?url=planos">LOGO</a></div><!--logo-->
            <nav>
                <ul>
                    <li><a href="?url=sobre">Sobre Nós</a></li>
                    <li><a href="?url=planos">Planos</a></li>
                    <li><a href="?url=modalidades">Modalidades</a>
                        <ul class="sub_menu">
                            <li><a href="#">Academia</a></li>
                            <li><a href="#">Fit Dance</a></li>
                            <li><a href="#">Pilates</a></li>
                        </ul>
                    </li>
                    <li><a href="?url=contato">Contato</a></li>
                    <li class="areaCliente"><a href="#">Área do cliente</a></li>
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
                <h3>Academia X</h3>
                <p>Rua Exemplo, 123 - Cidade/UF</p>
                <p><i class="fa-solid fa-phone"></i> (99) 99999-9999</p>
                <p><i class="fa-regular fa-envelope"></i> contato@academia.com</p>
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
        <p class="footer-copy">© 2025 Academia X. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
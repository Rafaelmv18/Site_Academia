<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="./style/home.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="center">
            <div class="logo"><a href="#">LOGO</a></div><!--logo-->
            <nav>
                <ul>
                    <li><a href="#sobre_nos">Sobre Nós</a></li>
                    <li><a href="#modalidade">Modalidades</a>
                        <ul class="sub_menu">
                            <li><a href="#">Academia</a></li>
                            <li><a href="#">Fit Dance</a></li>
                            <li><a href="#">Pilates</a></li>
                        </ul>
                    </li>
                    <li><a href="#contato">Contato</a></li>
                </ul>
            </nav>
        </div><!--center-->
    </header>

    <main>
        <section id="sobre_nos">
            <h2>Sobre Nós</h2>
        </section>

        <section id="modalidade">
            <h2>Modalidades</h2>
        </section>

        <section id="contato">
            <form>
                <input type="text" placeholder="Seu nome">
                <input type="email" placeholder="Seu e-mail">
                <textarea placeholder="Sua mensagem"></textarea>
                <button type="submit">Enviar</button>
            </form>
        </section>
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
                    <li><a href="#sobre">Sobre Nós</a></li>
                    <li><a href="#modalidades">Modalidades</a></li>
                    <li><a href="#contato">Contato</a></li>
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
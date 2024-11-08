<?php
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codemaze - Intranet</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilo geral da página */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Estilo da barra superior */
        .navbar {
            background-color: #222; /* Preto mais intenso */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
            position: fixed; /* Fixa a barra no topo */
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Garante que a barra fique acima de outros elementos */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilo dos itens da barra (ícones e textos) */
        .navbar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 13px; /* Texto ainda mais suave */
            margin: 0 15px; /* Espaçamento mais suave */
            transition: all 0.3s ease-in-out; /* Transição suave */
        }

        /* Cor dos ícones */
        .navbar a i {
            color: #d35400; /* Laranja mais escuro */
            font-size: 20px; /* Ícones com tamanho adequado */
            margin-right: 6px; /* Menos espaço entre ícone e texto */
            transition: all 0.3s ease-in-out; /* Transição suave para hover */
        }

        /* Efeito hover nos links */
        .navbar a:hover {
            opacity: 0.8;
            transform: scale(1.1); /* Leve aumento de tamanho */
        }

        .navbar a:hover i {
            color: #e67e22; /* Laranja mais intenso no hover */
        }

        /* Estilo dos iframes */
        iframe {
            width: 100%;
            height: calc(100vh - 50px); /* Altura da tela menos a altura da barra */
            border: none;
            margin-top: 0px; /* Remove o espaço entre a barra e o iframe */
            border-radius: 0px; /* Bordas arredondadas */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Ajuste para o conteúdo não ficar por trás da barra fixa */
        body {
            padding-top: 50px; /* Espaço para a barra não cobrir conteúdo */
        }

        /* Estilo da barra de navegação vertical */
        .vertical-nav {
            width: 200px; /* Largura da barra lateral */
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #333;
            display: block; /* Mostrar por padrão */
            padding-top: 20px;
            padding-left: 10px;
            z-index: 500; /* Garante que a barra lateral fique atrás da barra superior */
        }

        .vertical-nav a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 15px 0;
            font-size: 14px;
        }

        .vertical-nav a:hover {
            color: #e67e22; /* Laranja quando o mouse passa sobre */
        }

        /* CSS para ocultar a barra lateral */
        .hide-vertical-nav {
            display: none; /* Isso oculta a barra lateral */
        }
    </style>
</head>
<body>

    <!-- Barra superior com 8 ícones e textos -->
    <div class="navbar">
        <a href="#" onclick="loadIframe('dashboard.php');">
            <i class="fas fa-home"></i>
            SGCS
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/about');">
            <i class="fas fa-info-circle"></i>
            About
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/services');">
            <i class="fas fa-cogs"></i>
            Services
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/contact');">
            <i class="fas fa-phone-alt"></i>
            Contact
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/blog');">
            <i class="fas fa-blog"></i>
            Blog
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/portfolio');">
            <i class="fas fa-briefcase"></i>
            Portfolio
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/testimonials');">
            <i class="fas fa-comments"></i>
            Testimonials
        </a>
        <a href="#" onclick="loadIframe('https://www.example.com/faqs');">
            <i class="fas fa-question-circle"></i>
            FAQs
        </a>
    </div>

    <!-- Barra de navegação vertical (escondida por padrão) -->
    <div class="vertical-nav hide-vertical-nav" id="vertical-nav">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>

    <!-- Área do iframe onde o conteúdo será carregado -->
    <div id="iframe-container">
        <iframe id="iframe" src="https://www.example.com"></iframe>
    </div>

    <script>
        function loadIframe(url) {
            document.getElementById('iframe').src = url;
        }

        // Função para mostrar ou ocultar a barra lateral
        function toggleVerticalNav() {
            var nav = document.getElementById('vertical-nav');
            nav.classList.toggle('hide-vertical-nav');
        }
    </script>
</body>
</html>

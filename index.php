<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- reCaptcha -->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

     <!-- Site Metas -->
    <title>CODEMAZE - Soluções de MKT e Software</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        section {
            height: 600px; /* Altura das seções para simulação */
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            margin: 10px 0;
        }
    </style>

</head>
<body>

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__ball"></div>
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
    
	<div class="top-bar">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="left-top">
						<div class="email-box">
							<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> faleconosco@codemaze.com.br</a>
						</div>
						<div class="phone-box">
							<a href="tel:1234567890"><i class="fab fa-whatsapp" aria-hidden="true"></i> 11 98273-4350</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="right-top">
						<div class="social-box">
							<ul>
								<li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
							<ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <header class="header header_style_01">
        <nav class="megamenu navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logos/logocodemaze_preto.png" alt="image"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#slide" class="scroll-link">Home</a></li>
                        <li><a href="#about" class="scroll-link">Sobre nós</a></li>
                        <li><a href="#services" class="scroll-link">Soluções & Consultoria</a></li>
                        <li><a href="#hosting" class="scroll-link">Hosting</a></li>
						<li><a href="#contact" class="scroll-link">Contato</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
	
	<div id="slide" class="slider-area">
		<div class="slider-wrapper owl-carousel">
			<div class="slider-item home-one-slider-otem slider-item-four slider-bg-one">
				<div class="container">
					<div class="row">
						<div class="slider-content-area">
							<div class="slide-text"> 
								<h1 class="homepage-three-title">Campanhas que<span> convertem!</span></h1>
								<h2>Desenvolvemos anúncios precisos para atrair o público ideal. Aumente suas vendas com <br>investimento estratégico em mídia paga. Obtenha mais resultados gastando menos. </h2>
								<div class="slider-content-btn">
									<a class="button btn btn-light btn-radius btn-brd" href="#services">Leia mais</a>
									<a class="button btn btn-light btn-radius btn-brd" href="#contact">Contate-nos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item text-center home-one-slider-otem slider-item-four slider-bg-two">
				<div class="container">
					<div class="row">
						<div class="slider-content-area">
							<div class="slide-text">
								<h1 class="homepage-three-title">Consultoria digital para <span>você!</span></h1>
								<h2>Avaliamos sua presença online e sugerimos melhorias estratégicas. A Codemaze cria soluções  <br>personalizadas para seu negócio. Aumente resultados e reduza custos agora mesmo. </h2>
								<div class="slider-content-btn">
									<a class="button btn btn-light btn-radius btn-brd" href="#services">Leia mais</a>
									<a class="button btn btn-light btn-radius btn-brd" href="#contact">Contate-nos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item home-one-slider-otem slider-item-four slider-bg-three">
				<div class="container">
					<div class="row">
						<div class="slider-content-area">
							<div class="slide-text">
								<h1 class="homepage-three-title"><span>Mídias sociais</span> engajadas!</h1>
								<h2>A Codemaze cuida das suas redes para você se concentrar no negócio. Criamos conteúdo<br>envolvente e campanhas orgânicas. Aumente o engajamento e destaque sua marca!</h2>
								<div class="slider-content-btn">
									<a class="button btn btn-light btn-radius btn-brd" href="#services">Leia mais</a>
									<a class="button btn btn-light btn-radius btn-brd" href="#contact">Contate-nos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">
                        <h4>Quem somos</h4>
                        <h2>Bem vindo(a) a Codemaze</h2>
                            <p> Somos uma empresa especializada em soluções digitais, comprometida em transformar negócios e potencializar resultados no ambiente online. Com uma abordagem personalizada, oferecemos serviços de desenvolvimento de sites, hospedagem, consultoria estratégica, gerenciamento de mídias sociais e campanhas de tráfego pago.</p>

                            <p><b>Nosso objetivo</b> é ajudar empresas a se destacarem no mercado digital com experiências únicas e estratégias eficientes. Atuamos lado a lado com nossos parceiros, entendendo suas necessidades e adaptando soluções para maximizar resultados. Com uma equipe apaixonada por inovação, buscamos sempre as melhores práticas do mercado. Na Codemaze, seu sucesso é a nossa prioridade — crescer juntos é nossa essência.</p>

                        <a href="#services" class="btn btn-light btn-radius btn-brd grd1">Leia mais</a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="post-media wow fadeIn">
                        <img src="uploads/about_01.jpg" alt="" class="img-responsive img-rounded">
                        <a href="http://www.youtube.com/watch?v=nrJtHemSPW4" data-rel="prettyPhoto[gal]" class="playbutton"><i class="flaticon-play-button"></i></a>
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->

            <hr class="hr1"> 

        </div><!-- end container -->
    </div><!-- end section -->
	

    <div id="services" class="parallax section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Soluções & Consultoria</h3>
                <p class="lead">Conte com a Codemaze para soluções eficazes e consultoria de qualidade. Juntos, vamos transformar suas ideias em realidade.</p>
            </div><!-- end title -->

            <div class="owl-services owl-carousel owl-theme">
                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="uploads/gestaoMidiaSocial.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="uploads/gestaoMidiaSocial.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Gestão de Mídia Social</h3>
						<p>Impulsione sua marca nas redes sociais com nosso serviço de destaque em mídias sociais! Criamos estratégias e campanhas personalizadas que aumentam seu engajamento e ampliam sua visibilidade.</p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="uploads/gestaoTrafego.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="uploads/gestaoTrafego.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Gestão de Tráfego (Mkt DIgital)</h3>
						<p>Maximize seus resultados com nossa gestão de tráfego digital! Implementamos campanhas estratégicas que direcionam visitantes qualificados ao seu site, aumentando as conversões e o retorno sobre o investimento. </p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="uploads/desenvolvimentoSItes.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="uploads/desenvolvimentoSItes.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Desenvolvimento de Sites</h3>
						<p>Transforme sua visão em realidade! Criamos websites personalizados, responsivos e otimizados para garantir uma experiência excepcional ao usuário. Deixe sua marca brilhar online com uma presença digital impactante.</p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="uploads/desenvolvimentoSistemas.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="uploads/desenvolvimentoSistemas.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Desenvolvimento de Sistemas</h3>
						<p>Desenvolvemos sistemas sob medida para atender às suas necessidades específicas! Nossos serviços abrangem desde a concepção até a implementação, garantindo soluções eficientes e integradas.</p>
					</div>
                </div>
                <!-- end service -->

                <div class="service-widget">
                    <div class="post-media wow fadeIn">
                        <a href="uploads/consultoria.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                        <img src="uploads/consultoria.jpg" alt="" class="img-responsive img-rounded">
                    </div>
					<div class="service-dit">
						<h3>Consultoria</h3>
						<p>Nossa consultoria oferece insights estratégicos para impulsionar o crescimento do seu negócio! Trabalhamos lado a lado com você para identificar oportunidades e implementar soluções eficazes.</p>
					</div>
                </div>
                <!-- end service -->
            </div><!-- end row -->

            <hr class="hr1">

        </div><!-- end container -->
    </div><!-- end section -->

    <div class="parallax section noover" data-stellar-background-ratio="0.7" style="background-image:url('uploads/parallax_05.png');">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="customwidget text-left">
                        <h1>Gestão de Mídia Social</h1>
                        <p>Maximize sua presença online com nosso serviço de Gestão de Mídia Social! <br>Oferecemos relatórios personalizados e estratégias inovadoras que aumentam o engajamento e potencializam sua marca.</p>
                        <ul class="list-inline">
                            <li><i class="fa fa-check"></i> Portal do Cliente</li>
                            <li><i class="fa fa-check"></i> Conteúdo programado</li>
                            <li><i class="fa fa-check"></i> Posts Animados</li>
                            <li><i class="fa fa-check"></i> Relatórios de engajamento</li>
                        </ul><!-- end list -->
                        <a href="#contact" data-scroll class="btn btn-light btn-radius btn-brd">Contate-nos</a>
                    </div>
                </div><!-- end col -->
				<div class="col-md-6">
                    <div class="text-center image-center hidden-sm hidden-xs">
                        <img src="uploads/deviceCodemaze.png" alt="" class="img-responsive wow fadeInUp">
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->


    <!-- ini hospedagem planos -->

    <div id="hosting" class="section wb">
        <div class="container">
			<div class="section-title text-center">
                <h3>Hospedagem de sites</h3>
                <p class="lead">Escolha a Codemaze para uma hospedagem confiável e escalável. Nossos servidores otimizados proporcionam desempenho superior, enquanto nossa equipe está disponível 24/7 para garantir que seu site funcione sem interrupções.</p>
            </div><!-- end title -->

              <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <h3 class="title">Standard</h3>
                            <span class="sub-title">Hospedagem Linux</span>
                            <span class="year">Plano <br>anual</span>
                        </div>
                        <div class="price-value">
                            <div class="value">
                                <span class="currency">R$</span>
                                <span class="amount">14.<span>99</span></span>
                                <span class="month">/mês</span>
                            </div>
                        </div>
                        <ul class="pricing-content">
                            <li>500MB Disco</li>
                            <li>2 Contas FTP</li>
                            <li>2 Contas de e-mail</li>
                            <li>1GB Bandwidth</li>
                            <li>3 Subdominios</li>
                            <li>2 Banco de dados</li>
                        </ul>
                        <a href="#contact" class="pricingTable-signup">Escolha o Plano </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable purple">
                        <div class="pricingTable-header">
                            <h3 class="title">Business</h3>
                            <span class="sub-title">Hospedagem Linux</span>
                            <span class="year">Plano <br>anual</span>
                        </div>
                        <div class="price-value">
                            <div class="value">
                                <span class="currency">R$</span>
                                <span class="amount">18.<span>99</span></span>
                                <span class="month">/mês</span>
                            </div>
                        </div>
                        <ul class="pricing-content">
                            <li>1GB Disco</li>
                            <li>5 Contas FTP</li>
                            <li>10 Contas de e-mail</li>
                            <li>3GB Bandwidth</li>
                            <li>5 Subdominios</li>
                            <li>5 Banco de dados</li>
                        </ul>
                        <a href="#contact" class="pricingTable-signup">Escolha o Plano </a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="pricingTable blue">
                        <div class="pricingTable-header">
                            <h3 class="title">Premium</h3>
                            <span class="sub-title">Hospedagem Linux</span>
                            <span class="year">Plano <br>anual</span>
                        </div>
                        <div class="price-value">
                            <div class="value">
                                <span class="currency">R$</span>
                                <span class="amount">24.<span>99</span></span>
                                <span class="month">/mês</span>
                            </div>
                        </div>
                        <ul class="pricing-content">
                            <li>2GB Disco</li>
                            <li>10 Contas FTP</li>
                            <li>20 Contas de e-mail</li>
                            <li>10GB Bandwidth</li>
                            <li>8 Subdominios</li>
                            <li>10 Banco de dados</li>
                        </ul>
                        <a href="#contact" class="pricingTable-signup">Escolha o Plano </a>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->











    <!-- end hospedagem planos -->

	
    <!-- ini contato -->

    <div id="contact" class="section wb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Agende uma conversa</h3>
                <p class="lead">Preencha o formulário abaixo para agendar uma conversa e descobrir como nossos serviços podem atender às suas necessidades. <br>                    
                    Estamos prontos para ajudar você a alcançar seus objetivos!!</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactform" class="row" action="process_form.php" name="contactform" method="post">
                            <fieldset class="row-fluid">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Completo">
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="DDD + Telefone">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="sr-only">Área de interesse</label>
                                    <select name="service" id="service" class="selectpicker form-control" data-style="btn-white">
                                        <option value="12">Tráfego Pago</option>
                                        <option value="Web Design">Desenvolvimento de Site / Software</option>
                                        <option value="Web Development">Gerenciamento de Midias Sociais</option>
                                        <option value="Graphic Design">Consultoria</option>
                                        <option value="Others">Outros</option>
                                    </select>
                                </div>
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" name="mensagem" id="mensagem" rows="6" placeholder="Escreva aqui sua mensagem..."></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                <div id="form-contactform"></div>
                                <div class="g-recaptcha" data-sitekey="6LcZHF4qAAAAAPFlFjuVLHrKOvpQ9BzC6U_4uqoa"></div>
                                    <button type="submit" value="SEND" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Enviar</button>
                                </div>
                            </fieldset>
                        </form>

                    <!-- SCRIPT RECAPTCHA -->
                    <!-- Onde a mensagem de sucesso/erro será exibida -->
						
						<script src="https://www.google.com/recaptcha/api.js" async defer></script>

						<!-- Ajax para envio e exibicao do resultado sem load de pag nova -->
						<script>
							document.getElementById('contact_form').addEventListener('submit', function(e) {
							    e.preventDefault(); // Impede o envio tradicional do formulário
							
							    // Verifica o reCAPTCHA
							    var recaptchaResponse = grecaptcha.getResponse();
							    if (recaptchaResponse.length === 0) {
							        document.getElementById('form-contactform').innerHTML = "Por favor, complete o reCAPTCHA.";
							        return; // Se o reCAPTCHA não foi resolvido, não submeta o formulário
							    }
							
							    var formData = new FormData(this); // Captura todos os dados do formulário
							
							    var xhr = new XMLHttpRequest();
							    xhr.open('POST', this.action, true); // Configura o envio via POST para o arquivo PHP
							
							    xhr.onload = function() {
							        if (xhr.status === 200) {
							            // Exibe a resposta do servidor na página
							            document.getElementById('form-message').innerHTML = xhr.responseText;
							        } else {
							            document.getElementById('form-message').innerHTML = "Houve um erro no envio do formulário.";
							        }
							    };
							
							    xhr.send(formData); // Envia o formulário via AJAX
							});
						</script>













                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
			
			
			
        </div><!-- end container -->
    </div><!-- end section -->

    








    <!-- end contato -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <img src="images/logos/logocodemaze.png" alt="" />
                        </div>
                        <p>Telefone: +55 11 998273-4350<br>
                        local: Rua dos Estudantes, 505 - Hortolândia/SP<br>
                        Suporte Técnico: suporte@codemaze.com.br<br>
                        E-mail: faleconosco@codemaze.com.br<br>
                        </p>
                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Páginas</h3>
                        </div>

                        <ul class="footer-links hov">
                            <li><a href="#slide">Home <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#about">Sobre nós <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#services">Soluções & Consultoria <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#hosting">Hosting <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#contact">Contato <span class="icon icon-arrow-right2"></span></a></li>

                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-distributed widget clearfix">
                        <div class="widget-title">
                            <h3>Assine</h3>
							<p>Assine nossa newsletter e acompanhe novidades, tendências e dicas para fortalecer sua presença digital. Não perca as melhores oportunidades para impulsionar seu negócio!</p>
                        </div>
						
						<div class="footer-right">
							<form method="get" action="#">
								<input placeholder="Deixe seu e-mail na newsletter.." name="search">
								<i class="fa fa-envelope-o"></i>
							</form>
						</div>                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">                   
                    <p class="footer-company-name">Todos os direitos reservados. &copy; <?php echo date('Y'); ?> <a href="#slide">Codemaze</a></p>
                </div>

                
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/portfolio.js"></script>
    <script src="js/hoverdir.js"></script>    

    <script>
        document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
        e.preventDefault(); // Impede o comportamento padrão do link
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        // Rolagem suave com um delay
        setTimeout(() => {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 50); // Ajuste o tempo se necessário
    });
    });
    </script>


</body>
</html>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	
	<title>Departamento de Física - FFCLRP - USP</title>
	
	<link href="css/default.css" rel="stylesheet" type="text/css" />
	<link rel='shortcut icon' type='image/x-icon' href='img/favicon.ico' />
	
	<!--	Google Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
</head>

<body class="center">

<!-- start header -->
<header>
	<img src="img/logo_site.png" alt="Logo USP" width="100" height="100" class="left" />
	
	<div id="logo">
		<h1><a href="http://df.ffclrp.usp.br">Departamento de Física</a></h1>
		<h2><a href="http://www.ffclrp.usp.br" target="_blank">FFCLRP</a></h2>
	</div>
	
	<nav>
		<ul id="menu">
			<li <?= $index ?> ><a href="index.php"> home</a></li>
			<li <?= $cursos ?> ><a href="cursos.php">cursos</a>
				<ul>
					<li><a href="fisicamedica.php" title="Bacharelado em Física Médica" >Graduação - Física Médica</a></li>
					<li><a href="http://sites.usp.br/famb" 
					title="Mestrado em Física Aplicada à Medicina e Biologia" target="_blank">Mestrado - FAMB</a>
					</li>
					
					<li><a href="http://sites.usp.br/famb" 
					title="Doutorado em Física Aplicada à Medicina e Biologia" target="_blank">Doutorado - FAMB</a>
					</li>
				</ul>
			</li>
			
			<li <?= $pesquisa ;?> ><a href="pesquisa.php">pesquisa</a></li>
			
			<li>
				<a href="#">links úteis</a>
				<ul>
					<li><a href="http://portal.ffclrp.usp.br" title="Portal da Filosofia" target="_blank">Portal Filô</a></li>
					<li><a href="http://sites.ffclrp.usp.br/cefim/" title="Página do Centro Estudantil da Física Médica" target="_blank">CEFIM</a></li>
					<li><a href="http://email.usp.br" target="_blank">Webmail</a></li>
					<li><a href="http://sites.usp.br/famb" title="Página do programa de pós graduação FAMB" target="_blank">Página Pós FAMB</a></li>
				</ul>		
			</li>
			<li><a href="http://df.ffclrp.usp.br/sat/" title="Serviço de Atendimento Técnico" target="_blank">SAT</a></li>
			
		</ul>
	</nav>
	
</header>
<!-- end header -->

	
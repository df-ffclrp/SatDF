<?php
require("includes/functions.php");

# Inicializa variáveis de menu
require_once ("includes/resetvars.php");
# Pega nome da página para ativar o menu CSS
$cursos = active();


# Inclui cabeçalho
include_once("includes/header.php");
?>
	
	<!-- start content -->
	<div id="content">
		
		<div class="post">
			<h1 class="title">Cursos Oferecidos</h1>
			<div class="entry">
				<h2>Graduação</h2>
					<ul>
						<li><a href="fisicamedica.php">Física Médica - Bacharelado em Física Médica</a></li>
					</ul>				
				<h2>Pós-Graduação</h2>
					<ul>
						<li><a href="http://www.ffclrp.usp.br/posgraduacoes/fisica/mestradoemfisicaaplicadaamedicinaebiologia.php" target="_blank">Mestrado em Física Aplicada à Medicina e Biologia</a></li>
						<li><a href="http://www.ffclrp.usp.br/posgraduacoes/fisica/doutoradoemfisicaaplicadaamedicinaebiologia.php" target="_blank">Doutorado em Física Aplicada à Medicina e Biologia</a></li>
					</ul>	
			</div>
		</div>
	</div>
	
	<!-- end content -->
	

<?php
include("includes/footer.html")
?>
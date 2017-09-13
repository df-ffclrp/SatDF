<?php
# Inicializa variáveis de menu
require_once ("includes/resetvars.php");

# Pega nome da página para ativar o menu CSS
$cursos = 'class="active"';

# Inclui cabeçalho
include_once("includes/header.php");
?>
<section>
	<div class="conteudo">
		<h1>Cursos Oferecidos</h1>
			
			<h2>Graduação</h2>
				<ul>
					<li><a href="fisicamedica.php">Física Médica - Bacharelado em Física Médica</a></li>
				</ul>				
			
			<h2>Pós-Graduação</h2>
				<ul>
					<li><a href="http://sites.usp.br/famb" target="_blank">Mestrado em Física Aplicada à Medicina e Biologia</a></li>
					<li><a href="http://sites.usp.br/famb" target="_blank">Doutorado em Física Aplicada à Medicina e Biologia</a></li>
				</ul>	
	</div>
</section>

<?php
include("includes/footer.html")
?>

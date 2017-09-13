<?php
# Inicializa variáveis de menu
require_once ("includes/resetvars.php");

# Ativando menu ativo no CSS
$index = 'class="active"';

# Inclui cabeçalho
include("includes/header.php");
?>
<section>
	<!-- start content -->
	<div class="conteudo">

		<h1>Apresentação</h1>
				
		<p>Seja bem vindo! Nesse espaço estão disponíveis várias informações a respeito do 
		Departamento de Física (DF) da Faculdade de Filosofia, Ciências e Letras de Ribeirão Preto (FFCLRP).</p>

		<p>O Departamento de Física (DF) é responsável pelo curso de graduação em Física Médica, no período noturno, 
		com duração mínima de cinco anos. <p>

		<p>O Departamento também oferece disciplinas da área de Física a outros cursos da FFCLRP e de outras unidades do Campus de Ribeirão Preto.</p>

		<p>Desde 1986 oferece o curso de pós-graduação em Física Aplicada à Medicina e Biologia em nível de Mestrado e desde 1995 oferece o mesmo curso em nível de Doutorado. 
		Esse curso foi o primeiro nesta especialidade a ser oferecido na América Latina.</p>

		<p>Para saber mais sobre o curso de graduação, acesse a <a href="fisicamedica.php" title="Ir para página do curso de Física Médica" >página do curso</a>.</p>
	</div>
	
	<!-- end content -->
</section>

<?php
include("includes/footer.html")
?>

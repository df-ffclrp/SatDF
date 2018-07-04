<?php
# Inicializa variáveis de menu
require_once ("includes/resetvars.php");

# Pega nome da página para ativar o menu CSS
$pesquisa = 'class="active"';

# Inclui cabeçalho
include_once("includes/header.php");
?>

<section>
	<div class="conteudo">
		
		<h2>Laboratórios / Linhas de Pesquisa</h2>
			<ul>
				<li><a href="http://df.ffclrp.usp.br/biomag" target="_blank">Biomagnetismo</a></li>
				<li><a href="http://df.ffclrp.usp.br/inbrain" target="_blank">Inbrain</a></li>
				<li><a href="http://df.ffclrp.usp.br/cidra" target="_blank">Centro de Instrumentação, Dosimetria e Radioproteção (Cidra)</a></li>
				<li><a href="http://df.ffclrp.usp.br/giimus" target="_blank">Grupo de Inovação em Instrumentação Médica e Ultrassom (Giimus)</a></li>
				<li><a href="http://sisne.org" target="_blank">Laboratório de Sistemas Neurais (Sisne)</a></li>
				<li><a href="http://sites.usp.br/sensormat/" target="_blank">Sensormat</a></li>
				<li><a href="https://sites.google.com/site/grupocsim/" target="_blank">Grupo de Computação em Sinais e Imagens Médicas (CSIM)</a></li>
				<li><a href="http://www.biofisicamolecular.com.br/" target="_blank">Laboratório de Biofísica Molecular (LBM)</a></li>
				<li><a href="http://dcm.ffclrp.usp.br/fotobiofisica/index.html" target="_blank">Fotobiofísica</a></li>
				<li><a href="http://dgp.cnpq.br/dgp/espelhogrupo/7548264580175587" target="_blank">Fisica Radiológica e Dosimetria</a></li>
				<li><a href="http://fisestat.wordpress.com " target="_blank">Grupo de Física Estatística Teórica e Computacional</a></li>
			</ul>		
	</div>

</section>
	

<?php
include("includes/footer.html")
?>
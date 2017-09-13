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
		
		<h2>Laboratórios</h2>
			<ul>
				<li><a href="http://df.ffclrp.usp.br/biomag" target="_blank">Biomagnetismo</a></li>
				<li><a href="http://df.ffclrp.usp.br/inbrain" target="_blank">Inbrain</a></li>
				<li><a href="http://df.ffclrp.usp.br/cidra" target="_blank">Cidra</a></li>
				<li><a href="http://df.ffclrp.usp.br/giimus" target="_blank">Giimus</a></li>
			</ul>		
	</div>

</section>
	

<?php
include("includes/footer.html")
?>
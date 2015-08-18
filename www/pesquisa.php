<?php
# Inicializa variáveis de menu
require_once ("includes/resetvars.php");

# Pega nome da página para ativar o menu CSS
$pesquisa = 'class="active"';

# Inclui cabeçalho
include_once("includes/header.php");
?>
	<div class="conteudo">
		
		<h2>Laboratórios</h2>
			<ul>
				<li><a href="http://df.ffclrp.usp.br/biomag" target="_blank">Biomagnetismo</a></li>
				<li><a href="http://df.ffclrp.usp.br/inbrain" target="_blank">Inbrain</a></li>
			</ul>		
	</div>

	
<!-- end content -->
	</section>
	

<?php
include("includes/footer.html")
?>
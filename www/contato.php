<?php
require("includes/functions.php");

# Inicializa variáveis de menu
require_once ("includes/resetvars.php");
# Pega nome da página para ativar o menu CSS
$contato = active();

# Inclui cabeçalho
include_once("includes/header.php");
?>
	
	<!-- start content -->
	<div id="content">
		
		<div class="post">
			<h1 class="title">Contato</h1>
			<div class="entry">
				
			</div>
		</div>
	</div>
	
	<!-- end content -->
	

<?php
include("includes/footer.html")
?>
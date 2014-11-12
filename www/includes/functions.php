<?php
# Arquivo de funções Básicas

# Funcão que mostra menu ativo no menu de navegação
function active() {
	$idPagina = basename($_SERVER['PHP_SELF'], ".php");
	
	switch($idPagina) {
		case 'index':		
		$ativo = 'class="active"';
		break;
		
		case 'quem':		
		$ativo = 'class="active"';
		break;
	
		case 'pesquisa':		
		$ativo = 'class="active"';
		break;
		
		case 'contato':		
		$ativo = 'class="active"';
		break;
		
		case 'cursos':		
		$ativo = 'class="active"';
		break;
	}		
	
	return $ativo;
}
?>
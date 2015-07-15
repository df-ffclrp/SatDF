<?php
session_start();

# Cabeçalho padrão HTML
include('includes/header.html');

# Funções básicas do programa
require_once ('includes/functions.php');

# inicializa variável de controle de erros
$_SESSION['erro'] = 0;

include ('stubs/session.php');
#############################################################

# Se tem Session, mostra o formulário para o usuário
if(isset($_SESSION['num_usp'])) {
	//debug_var($_SESSION,"Variável de Sessão");
	
	if(isset($_SESSION['erro'])) {
		$erro = $_SESSION['erro'];
	}
	
	# Trata mensagem de demonstracao da oficina
	$oficina_destino = $_SESSION['oficina_destino'];
		if ($oficina_destino == 1){
			$oficina_titulo = "Oficina Mecânica";
		}
		else {
			$oficina_titulo = "Oficina de Eletrônica";
		}
?>

	<!-- Inicia Form -->
	
	<div id="form_pedido">
	
		  	<h2>FORMULÁRIO DE ORDEM DE SERVIÇO </h2> 
	    	<h3 id="oficina_titulo"><?= $oficina_titulo;?> </h3> 

    	<p><span class='label'> Solicitante: </span><?= $_SESSION['nome'];?></p>  
    	<p><span class='label'> Número USP:  </span><?= $_SESSION['num_usp'];?></p>
		<br />
		
		<?php
				if($erro==1) { echo '<h3 id="erro"> Preencher todos os campos!</h3>';} 
		 ?>
		 
	<form action="processa_pedido.php" method="post">

	<!-- Detalhes Pedido -->
		<div class="formulario">
	    	<h3>Detalhes do Pedido</h3>
				
				<div class="form_inputs">
		    		<p>Nome do Projeto</p>
		    		<input type="text" name="nome_projeto" size="50" <?php if($erro) echo " value=".$_SESSION['nome_projeto']; ?>	>
					
		    		<p>Finalidade</p>
		    		<?php 
							if($erro==1){
								$finalidade = $_SESSION['finalidade'];
							} else {
								$finalidade = 1;
							}
						?>
						
					<select name="finalidade" >
		        		<option value="1" <?php if($finalidade==1){ echo " selected"; }?> >Projetos Didáticos</option>
		        		<option value="2" <?php if($finalidade==2){ echo " selected"; }?> >Projetos de Pesquisa</option>
		        		<option value="3" <?php if($finalidade==3){ echo " selected"; }?> >Projetos de Laboratórios</option>
		        		<option value="4" <?php if($finalidade==4){ echo " selected"; }?> >Manutenção</option>
		    		</select>
		    		
							
		    		<p>Descrição do pedido</p>
					    	<textarea name="desc_pedido" cols="85" rows="6"><?php if($erro==1){echo $_SESSION['desc_pedido'];}?></textarea>
				</div>
			</div>
	<!-- FIM - Detalhes Pedido -->
					
	<!-- Detalhes Material -->
		<div class="formulario">  
		    	<h3>Material</h3>
		    	<div class="form_inputs">
				<?php 
					if($erro == 1){
						$forn_material = $_SESSION['forn_material'];
					} else {
						$forn_material = 1;
					}
				?>
				<p>Fornecimento do Material</p>
				<select name="forn_material">
					<option value="1" <?php if($forn_material==1){ echo " selected"; }?> >Fornecido pelo solicitante</option>
	        		<option value="2" <?php if($forn_material==2){ echo " selected"; }?> >Fornecido pelo Departamento</option>
		    	</select>
		    		
		    	  	<p>Descrição do Material</p>
		    	<textarea name="desc_material" cols="85" rows="6">
		    		<?php if($erro==1){echo $_SESSION['desc_material'];} ?>
		    	</textarea>
		    	</div>
		</div>
    	
		
    		<input class="botao" type="submit" name="envia_pedido" value="Enviar Pedido" />
    	<!-- FIM Detalhes Material -->
		</form>
		</div>
</body>
</html>
<?php	
}	

else 
	echo "bugou o script do form";
?>
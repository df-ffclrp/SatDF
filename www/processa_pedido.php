<?php
session_start();

# Cabeçalho padrão HTML
include('includes/header.html');

# Funções básicas de tratamento de erros
require_once ('includes/functions.php');

# inclui funcoes de conexao com o banco
include ('includes/conexao.php');

# inicializa variável de controle de erros
$_SESSION['erro'] = 0;

# Se o Post foi preenchido:
if(isset($_POST['envia_pedido'])) {
	
	foreach($_POST as $chave => $valor){
		# Transforma em variáveis de sessão
		$_SESSION[$chave] = $valor;
	}

	# Se algum dos campos obrigatórios estiver vazio, ativa flag de erros
	if(empty($_SESSION['desc_pedido']) || empty($_SESSION['desc_material']) || empty($_SESSION['nome_projeto'])) {
		$_SESSION['erro'] = 1;
	}

	# Se não houve erros, processa o pedido para a impressão
	if($_SESSION['erro'] == 0){
		
			# Cria data do Sistema para o SGBD
			$datetime = date ("Y-m-d H:i:s");

			# Cria data amigável para impressão
			$_SESSION['data_abertura'] = date ("d/m/Y H:i:s");
			
			# Preparando query para armazenar no banco:
			# Campos no banco:
			
			# sol_id
			# sol_oficina_destino
			# sol_nome_projeto
			# sol_descricao
			# sol_finalidade
			# sol_data_abertura
			# sol_data_fechamento
			# sol_fornecimento_material
			# sol_descricao_material
			# fun_id_tec_responsavel
			# fun_id_solicitante
			# sol_status
	
			# Prepara insert do banco
			
			foreach($_SESSION as $chave => $valor){
				# Prepara variáveis e testa erros
				$_SESSION[$chave] = test_input($valor);			
			}

			$oficina_destino = $_SESSION['oficina_destino'];
			$desc_pedido = $_SESSION['desc_pedido'];
			$finalidade = $_SESSION['finalidade'];
			$nome_projeto = $_SESSION['nome_projeto'];
			$forn_material = $_SESSION['forn_material'];
			$desc_material = $_SESSION['desc_material'];
			$solicitante = $_SESSION['fun_id'];
			
			
			$query = "INSERT INTO solicitacao VALUES (
			'NULL',
			'$oficina_destino',
			'$nome_projeto',			
			'$desc_pedido',
			'$finalidade',
			'$datetime',
			'NULL',
			'$forn_material',
			'$desc_material',
			'1',
			'$solicitante',
			'1'
			)";
			
			# Envia consulta ao banco
			$result = mysql_query($query) or die ("Ocorreu um erro ao inserir os dados -> ". mysql_error());
			
			if($result) {
				$_SESSION['imprimir'] = 1;
				$_SESSION['last_sol_id'] = mysql_insert_id();
	
				# debug
//				header('location:works.php');


				header('location:imprime_pedido.php');
				mysql_close();
				exit();
			}
		
		}// IF do insert ao banco




	
	}// IF testa POST e SESSION

if(isset($_SESSION['num_usp'])) {
	# inicializa variável de erros. Se o POST não foi enviado,
	# o script iniciará aqui.
	$erro = 0;
	
	# verifica se ocorreu erros no IF anterior. Se sim mostra o conteúdokjh
	# para o usuário 
	if(isset($_SESSION['erro'])) {
		$erro = $_SESSION['erro'];
	}
	# Trata mensagem de demonstracao da oficina
	$oficina_destino = $_SESSION['oficina_destino'];
		if ($oficina_destino == 1){
			$oficina_titulo = "Oficina Mec&acirc;nica";
		}
		else {
			$oficina_titulo = "Oficina de Eletr&ocirc;nica";
		}
?>

	<!-- Inicia Form -->
	
	<div id="pedido">
		<div class="titulo_pedido">
	    	<h2>Formul&aacute;rio de Ordem de Serviço </h2> 
	    	
	    	<h3 class="titulo_pedido"><?= $oficina_titulo;?> </h3> 
		</div>

    	<strong>Solicitante:</strong> <?php echo $_SESSION['nome'];?> <br />
    	<strong>Número USP:</strong> <?php echo $_SESSION['num_usp'];?> <br />
		<br />
		
		<?php
				if($erro==1) { echo "<h3 id=\"erro\"> <u><strong>Preencher todos os campos!</strong></u> </h3><br />";} 
		 ?>
		 
	<form action="processa_pedido.php" method="post">

		<fieldset>
	    	<legend><strong>Detalhes do Pedido</strong></legend>
	
	    		<strong>Nome do Projeto</strong>
	    		<input type="text" name="nome_projeto" size="50" 
				
						<?php if($erro){
							echo " value=".$_SESSION['nome_projeto'];			
						
						}?>
				
				>
	    		<br /> 
	    		<br />
	
	    		<strong>Finalidade</strong>
	    		<?php 
						if($erro==1){
							$finalidade = $_SESSION['finalidade'];
						} else {
							$finalidade = 1;
						}
					?>
				<select name="finalidade" >
	        		<option value="1" <?php if($finalidade==1){ echo " selected"; }?> >Projetos Did&aacute;ticos</option>
	        		<option value="2" <?php if($finalidade==2){ echo " selected"; }?> >Projetos de Pesquisa</option>
	        		<option value="3" <?php if($finalidade==3){ echo " selected"; }?> >Projetos de Laborat&oacute;rios</option>
	        		<option value="4" <?php if($finalidade==4){ echo " selected"; }?> >Manuten&ccedil;&atilde;o</option>
	    		</select>
	    		
				<br />
				<br />
			
	    		<strong>Descrição do pedido</strong><br />
				    	<textarea name="desc_pedido" cols="85" rows="6"><?php if($erro==1){echo $_SESSION['desc_pedido'];}?></textarea>
			</fieldset>
					

		<fieldset>  
		    	<legend><strong>Material</strong></legend>
				<?php 
					if($erro){
						$forn_material = $_SESSION['forn_material'];
					} else {
						$forn_material = 1;
					}
				?>		
		
		    	<input name="forn_material" type="radio" value="1" <?php if($forn_material==1) echo " checked"; ?>>
		    		<b>Fornecido pelo Departamento</b> <br />
		    	<input name="forn_material" type="radio"  value="2" <?php if($forn_material==2) echo " checked"; ?>>
		    		<b>Fornecido pelo Solicitante</b> <br />
		    		
		    		<br />
		    		
		    	  	<strong>Descri&ccedil;&atilde;o do Material</strong><br />
		    	<textarea name="desc_material" cols="85" rows="6"><?php if($erro==1){echo $_SESSION['desc_material'];} ?></textarea>
		</fieldset>
    	
		
    		<input class="btn_enviar" type="submit" name="envia_pedido" value="Enviar Pedido" />
		</form>
<?php
}
	else {
		# Se a página foi acessada sem nada preenchido retorna para a página inicial
		session_destroy();
		header('location:oficina.php');
	}

?>

<?php
session_start();

# inclui o cabecalho html padrao
include ('includes/header.html');
include ('includes/conexao.php');
require ('includes/functions.php');

# Se o botao enviar foi pressionado, 
# caso contrario, aborte com mensagem de erro
if (isset ($_POST['enviar']) ) {
	
	$num_usp = $_POST['num_usp'];
	$oficina_destino = $_POST['oficina_destino'];
	
	# Se o campo estiver vazio, mostra menasgem para o usuário
	if (empty($num_usp)){
		$erro="Campo 'Número USP' necessário";		
	} 
	
	else {
		
			# Verificacao se o usuário está cadastrado no sistema	
				
			# Prepara select do banco
			$num_usp = test_input($num_usp);			
			
			$query = "SELECT * FROM funcionario WHERE fun_num_usp=$num_usp AND fun_ativo=1";
			
			conecta();
			# Envia consulta ao banco
			$result = mysql_query($query) or die (mysql_error());
		
			# verifica se retornou resultados
			$linha = mysql_num_rows($result);
				
			# Testa resultado retirado da query
			
			if ($linha){
	
				# Retira dados do array de resposta
				$array_result =	mysql_fetch_assoc($result);
				
				# Retira Variaveis do array e transforma em variaveis de sessao:
				$_SESSION['fun_id']			= $array_result['fun_id'];		
				$_SESSION['num_usp'] 		= $array_result['fun_num_usp'];
				$_SESSION['nome']    		= $array_result['fun_nome'];
				$_SESSION['ramal'] 			= $array_result['fun_ramal'];
				$_SESSION['email']			= $array_result['fun_email'];
				$_SESSION['tipo_oficina']	= $array_result['fun_tipo_oficina'];
			
				#armazena destino da oficina na variável de Sessão
				$_SESSION['oficina_destino'] = $oficina_destino;
				
				# Se não tem erro, manda para a próxima página
				
				# debug
				//header('location:works.php');
				
				header('location:processa_pedido.php');
				
				mysql_close();
				exit();
			}
				
				else {
					$erro = "Número USP inválido ou não casdastrado. Solicite o cadastramento no ramal 0077";
				}	
			}
} 
		?>
	<div class="conteudo">
				<h1><img src="img/wrench.png"/> Serviço de Atendimento Técnico</h1>
				
				<form action="oficina.php" method="post">
				<?php	
					# mostra mensagem de erro caso haja erros no processamento
						if (isset($erro)){
							echo '<p id="erro">'.$erro.'</p>';
						}
				?>
					Número USP <input type="text" name="num_usp" size="20" maxlenght="10">
					<br />
					
					Área de atendimento
					<select name="oficina_destino">
						<option value="1" selected>Oficina Mecânica</option>
						<option value="2">Oficina de Eletrônica</option>
					</select>

			<br>
			<input type="submit" name="enviar" value="Enviar Dados">
		</form>
	</div>
		

<!-- end page -->
</body>
</html>

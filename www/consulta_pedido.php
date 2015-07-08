<?php
	# Cabecalho da página de impressão
	require_once('includes/header_imprimir.html');

if(isset($_GET['id_os'])) {

	require_once('includes/conexao.php');
	require_once('includes/functions.php');	
	
	# Reduz variáveis	
	$id_os = $_GET['id_os'];
		
	# Prepara select do banco
	$id_os = test_input($id_os);			
		
	$query = "SELECT * FROM funcionario, solicitacao WHERE sol_id=$id_os AND fun_id_solicitante = fun_id AND sol_status<>0";
			
	# Envia consulta ao banco
	$result = mysql_query($query) or die (mysql_error());
	
	# verifica se retornou resultados
	$linha = mysql_num_rows($result);
				
	# Compara resultado retirado da query
			
	if ($linha){
	
			# Retira dados do array de resposta
			$array_result =	mysql_fetch_assoc($result);
			
			//debug_var($array_result,'v');
			
			# Transforma array em variáveis simples
			extract($array_result);
			
			mysql_close();
	
				
### Tratamento das mensagens aos usuários ###
	
	# Destino da Oficina
	# 1 = Oficina Mecânica
	# 2 = Oficina de Eletrônica	
	
	if($sol_oficina_destino==1) {
		$oficina_titulo = "Oficina Mecânica";
	} else {
		$oficina_titulo = "Oficina de Eletrônica";
	}	

	# Responsáveis pela Oficina
	$staff_and_rows = retrieve_staff($sol_oficina_destino);	
	
	# Quantidade de registros
	$rows = $staff_and_rows['rows'];
	
	# Retira array contendo os funcionários
	$staff = $staff_and_rows['staff'];
	
	# Varre o array bidimensional criando um array com os nomes de responsáveis
	for($i=1; $i<=$rows; $i++) {
		$resp[$i] = $staff[$i]['fun_nome'];
	}
		
	# Finalidade
	# 1 = Projetos Didáticos; 
 	# 2 = Projetos de Pesquisa; 
	# 3 = Projetos de Laboratório; 
	# 4 = Manutenção
	
	# Inicializando variável
	$finalidade = 0;
	switch($sol_finalidade) {
		case 1:
			$finalidade = "Projetos Didáticos";
			break;
			
		case 2:
			$finalidade = "Projetos de Pesquisa";
			break;
		
		case 3:
			$finalidade = "Projetos de Laboratório";
			break;
		
		case 4:
			$finalidade = "Manutenção";
			break;
	}
	
	# Fornecimento do Material
	
	if($sol_fornecimento_material==1) {
		$fornecimento_material = "Fornecido pelo Departamento";
	} else {
		$fornecimento_material = "Fornecido pelo Solicitante";
	}

?>

		<!-- Cabeçalho -->
		<div class="cabecalho">
				<h2>Ordem de Servico - <?= $oficina_titulo ?> </h2>
		</div>
		
		<br />	

		<!-- Solicitante -->
		<div class="box_dados">
			<h3>Dados do solicitante</h3>
			<strong>Nome: </strong> <?= $fun_nome; ?>  <br />
			<strong>Numero USP: </strong> <?= $fun_num_usp; ?> <br />
			<strong>Ramal: </strong> <?= $fun_ramal ?> <br />
						
		</div>
		<br />
		
		<!-- Pedido -->				
		<div class="box_dados">
			<h3>Detalhes do Pedido</h3>
	    	<strong>Número do Pedido: </strong> <?= $sol_id ?> <br />
			<strong>Data de Abertura: </strong> <?= $sol_data_abertura; ?> <br />		
			<strong>Nome do Projeto:</strong>  <?= $sol_nome_projeto; ?> <br />
			<strong>Finalidade: </strong> <?= $finalidade; ?> 
						
				<br />
				<br />
				
				<strong>Descrição do Pedido:</strong><br />

				<div class="box_descricao">
	 				<?= $sol_descricao?>
				</div>
		</div>
		
		<br />
		
		<div class="box_dados">
			<h3><strong>Dados do Material:</strong></h3>

			<strong>Fornecimento: </strong> <?= $fornecimento_material ?>
				
			<br />
			<br />
		
			<strong>Descri&ccedil;&atilde;o do Material:</strong><br />
			
			<div class="box_descricao">
	 			<?= $sol_descricao_material; ?>
			</div>
		</div>
<div class="container_assinaturas">		
		<div class="assinaturas">
					
					<div class="idf_solicitante">
					<?= $fun_nome; ?><br />
						<strong>Solicitante</strong>
					</div>
			
					
					
					<div class="idf_responsavel">	
					<?php
						foreach($resp as $chave=>$valor){
							echo $valor."<br />";						
						}
					?>
					<strong>Responsáveis</strong>
					</div>
					
		</div>
</div>
</body>
</html>
<?php
	} #finaliza if($linha)
# Finaliza IF
} 
	else {
		echo "<br /> <br /><h3><center>Solicitação não encontrada</center></h3>";		
		echo "</body>";
		echo "</html>";
		
		exit();
	}	

?>

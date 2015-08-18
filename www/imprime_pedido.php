<?php
session_start();

# Cabecalho da página de impressão
require_once('includes/header_imprimir.html');

# Stub
//require_once('stubs/session_print.php');

if(isset($_SESSION['num_usp']) && isset($_SESSION['imprimir'])) {
	require_once('includes/functions.php');
	
	# Envio de email para:
	# - Responsáveis pela oficina (Técnicos)
	# - Solicitante
	# - Docente responsável pela oficina
	
	# Recupera do banco os técnicos responsáveis e Docente
	# retrieve staff retorna um array multidimensional contendo:
	# $staff_and_rows['rows']
	# $staff_and_rows['staff']
	
	# rows -> número de funcionários encontrados na consulta
	# staff -> contem um array bidimensional no seguinte formato:
	# INDICE -> Linha do banco
	# staff[INDICE][COLUNA DO BANCO DE DADOS] == dado daquela coluna 
	
	# O parâmetro de entrada é o ID da oficina trabalhada	
	$staff_and_rows = retrieve_staff ($_SESSION['oficina_destino']);
	
	
	# Envia email de notificação:
	
	# Criando variáveis curtas (frescura)
	$os_id = $_SESSION['last_sol_id'];
	$oficina_destino = $_SESSION['oficina_destino'];
	$url_sistema = "http://df.ffclrp.usp.br/sat/"; // Cria link enviado no email
	
	#################################################################
	# 								ENVIA EMAIL
	
	
	send_email($staff_and_rows,$os_id,$oficina_destino,$url_sistema);	
		
	#################################################################

### Tratamento das mensagens aos usuários ###
	
	# Destino da Oficina
	# 1 = Oficina Mecânica
	# 2 = Oficina de Eletrônica	
	
		if($_SESSION['oficina_destino']==1) {
			$oficina_titulo = "Oficina Mecânica";
		} else {
			$oficina_titulo = "Oficina de Eletrônica";
		}	

	# Finalidade
	# 1 = Projetos Didáticos; 
 	# 2 = Projetos de Pesquisa; 
	# 3 = Projetos de Laboratório; 
	# 4 = Manutenção
	
	# Inicializando variável
	$finalidade = 0;
	switch($_SESSION['finalidade']) {
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
	
	if($_SESSION['forn_material']==1) {
		$fornecimento_material = "Fornecido pelo Departamento";
	} else {
		$fornecimento_material = "Fornecido pelo Solicitante";
	}

	# Recupera responsáveis pelo laboratório
	$rows = $staff_and_rows['rows'];
	
	# Retira array contendo os funcionários
	$staff = $staff_and_rows['staff'];
	
	# Varre o array bidimensional criando um array com os nomes de responsáveis
	for($i=1; $i<=$rows; $i++) {
		$resp[$i] = $staff[$i]['fun_nome'];
	}


?>

		<!-- Cabeçalho -->
		
		<h2 id="titulo">Ordem de Serviço - <?= $oficina_titulo ?> </h2>
		
		<!-- Solicitante -->
		<div class="box_dados">
			<h3>Dados do solicitante</h3>
			
			<p><span class="label">Nome: </span> <?= $_SESSION['nome']; ?> </p>
			<p><span class="label">Numero USP: </span> <?= $_SESSION['num_usp']; ?> </p>
			<p><span class="label">Ramal: </span> <?= $_SESSION['ramal']; ?> </p> 
			<span class="label">Email: </span> <?= $_SESSION['email']; ?>  <br />
			
		</div>
		
		<!-- Pedido -->				
		<div class="box_dados">
			<h3>Detalhes do Pedido</h3>
	    	<p><span class="label">Número do Pedido: </span> <?= $_SESSION['last_sol_id']; ?> </p> 
			<p><span class="label">Data de Abertura: </span> <?= $_SESSION['data_abertura']; ?> 	</p>
			<p><span class="label">Nome do Projeto:</span>  <?= $_SESSION['nome_projeto']; ?> </p>
			<p><span class="label">Finalidade: </span> <?= $finalidade; ?> </p>
			
			<p><span class="label">Descrição do Pedido:</span></p>

				<div class="box_descricao">
	 				<?= $_SESSION['desc_pedido']?>
				</div>
		</div>
		
		
		<div class="box_dados">
			<h3>Dados do Material:</h3>

			<p><span class="label" >Fornecimento: </span> <?= $fornecimento_material ?> </p>
			<p><span class="label">Descrição do Material:</span></p>
			
			<div class="box_descricao">
	 			<?= $_SESSION['desc_material']; ?>
			</div>
		</div>
		
		<!-- Assinaturas -->		
		<div class="container_assinaturas">
			<div class="assinaturas">
					
				<div class="idf_solicitante">
					<?= $_SESSION['nome']?><br />
				<span>	Solicitante</span>
				</div>
				
				<div class="idf_responsavel">	
					<?php
						foreach($resp as $chave=>$valor){
							echo $valor."<br />";						
						}
					?>
					<span> Responsáveis </span>
				</div>
			</div>
		</div>
</body>
</html>

<?php
	# Finaliza IF e Encerra sessão
	session_destroy();

} else {
	
	# Se o script foi invocado sem a variável de sessão imprimir, volta pra página inicial
	session_destroy();
	
	//echo "imprimir não setado";
	header('location:oficina.php');
}

?>

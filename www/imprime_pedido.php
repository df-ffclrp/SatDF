<?php
session_start();

# Cabecalho da página de impressão
require_once('includes/header_imprimir.html');
require_once('stubs/session_print.php');

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
	# função localizada no arquivo functions.php
	//send_email($staff_and_rows,$os_id,$oficina_destino,$url_sistema);		
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
		<div class="cabecalho">
				<h2>Ordem de Servico - <?= $oficina_titulo ?> </h2>
		</div>
		
		<br />

		<br />	

		<!-- Solicitante -->
		<div class="box_dados">
			<h3>Dados do solicitante</h3>
			<strong>Nome: </strong> <?= $_SESSION['nome']; ?>  <br />
			<strong>Numero USP: </strong> <?= $_SESSION['num_usp']; ?> <br />
			<strong>Ramal: </strong> <?= $_SESSION['ramal']; ?> <br />
			<strong>Email: </strong> <?= $_SESSION['email']; ?>  <br />
			
		</div>
		<br />
		
		<!-- Pedido -->				
		<div class="box_dados">
			<h3>Detalhes do Pedido</h3>
	    	<strong>Número do Pedido: </strong> <?= $_SESSION['last_sol_id']; ?> <br />
			<strong>Data de Abertura: </strong> <?= $_SESSION['data_abertura']; ?> <br />		
			<strong>Nome do Projeto:</strong>  <?= $_SESSION['nome_projeto']; ?> <br />
			<strong>Finalidade: </strong> <?= $finalidade; ?> 
						
				<br />
				<br />
				
				<strong>Descrição do Pedido:</strong><br />

				<div class="box_descricao">
	 				<?= $_SESSION['desc_pedido']?>
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
	 			<?= $_SESSION['desc_material']; ?>
			</div>
		</div>
<div class="container_assinaturas">
		<div class="assinaturas">
					
					<div class="idf_solicitante">
					<?= $_SESSION['nome']?><br />
					<strong>	Solicitante</strong>
					</div>
				
					<div class="idf_responsavel">	
					<?php
						foreach($resp as $chave=>$valor){
							echo $valor."<br />";						
						}
					?>
					<strong> Responsáveis </strong>
					</div>
</div>
</div>
</body>
</html>
<?php
# Finaliza IF
	# Encerra sessao
	session_destroy();
} else {
	# Se o script foi invocado sem a variável de sessão imprimir, volta pra página inicial
	session_destroy();
	echo "imprimir não setado";
//	header('location:oficina.php');
}

?>

<?php
session_start();
include('includes/header.html');
require('includes/functions.php');


# Se o Post foi preenchido:
if(isset($_POST['envia_pedido'])) {
	
	# Transforma em variáveis de sessão
	foreach($_POST as $chave => $valor){
		$_SESSION[$chave] = $valor;
	}

	# Se algum dos campos obrigatórios estiver vazio, ativa flag de erros
	if(empty($_SESSION['desc_pedido']) || empty($_SESSION['desc_material']) || empty($_SESSION['nome_projeto'])) {
		$_SESSION['erro'] = 1;
		header('location:form_pedido.php');
	}
		
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
	
	$conexao = conectaDB();
	# Envia consulta ao banco
	$result = mysqli_query($conexao,$query) or die ("Ocorreu um erro ao cadastrar a solicitação" . mysqli_error($conexao));
	
	debug_var($result, 'result', 'p');
		if($result) {
			$_SESSION['imprimir'] = 1;
			$_SESSION['last_sol_id'] = mysqli_insert_id($conexao);
		
			header('location:imprime_pedido.php');
			//debug_var($_SESSION, 'Sessão', 'p');
			mysqli_close($conexao);
			exit();
		}
		
	}// IF Botão apertado




else {
	session_destroy();
	echo "Ninguém preencheu nada";
}	
	

?>






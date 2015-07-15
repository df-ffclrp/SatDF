<?php
# configuracao de conexao com o banco de dados

function conectaDB() {

    # Adiciona os parâmetros da conexão
    require('config.php');

	# Prepara a conexao
	$connect = mysqli_connect($dbaddress, $dbuser, $dbpass) or die ("Não foi possível conectar ao banco de dados");

    # Configura as transações para UTF-8
 	mysqli_set_charset($connect, 'utf8');

	# Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
	if (!$connect) {
		echo "<h1>Falha na conexao com o Banco de Dados!</h1>";
		mysqli_error($connect);
 	}
	 else {
	# Caso a conexão seja aprovada, então conecta o Banco de Dados.
	$db = mysqli_select_db($connect,$dbname) or die ("Não foi possível selecionar o banco ." . mysqli_error($connect));
	}
    return $connect;
}
?>



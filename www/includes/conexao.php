<?php
# configuracao de conexao com o banco de dados

$dbaddress='localhost';
$dbuser='oficina';
$dbpass='xZA5UeRasaQv5yJ8';
$dbname='sis_oficina';

	# Prepara a conexao
	$connect = mysql_connect($dbaddress, $dbuser, $dbpass);
 	mysql_set_charset('utf8', $connect);
	# Caso a conexão seja reprovada, exibe na tela uma mensagem de erro
	if (!$connect) {
		echo "<h1>Falha na conexao com o Banco de Dados!</h1>";
		mysql_error();
 	}
	 else {
	# Caso a conexão seja aprovada, então conecta o Banco de Dados.
	$db = mysql_select_db($dbname) or die (mysql_error());
	}
?>



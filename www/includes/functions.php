<?php
# Arquivo de funções da aplicação

##############################################
# configuracao de conexao com o banco de dados
##############################################

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

############################
# Função para enviar email
############################
/*
Função específica para enviar um email apara os responsáveis pelas oficinas
Parâmetros:

- recipients (array) = array multidimensional gerado pela função retrieve_staff()
- id_os (int) = ID gerado pelo MySQL no momento da inserção dos dados. Está armazenado em sessão.
- workshop (int) = ID da oficina. Está armazenado em sessão.
- url_os (string) = Localização do script de consulta de dados (no caso: consulta_pedido.php)

*/

function send_email($recipients,$id_os,$workshop,$url_os) {
	require 'PHPMailerAutoload.php';

	# Trata oficina de destino
	if($workshop == 1) {
		$show_workshop = "Oficina Mecânica";
	} else {
		$show_workshop = "Oficina de Eletrônica";
	}

	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->CharSet="utf-8";
	$mail->Host = 'smtp.host.com';
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'my_email@host.com';         // SMTP username
	$mail->Password = 'my_pass';                    // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = '587';
	$mail->From = 'my_email@host.com';
	$mail->FromName = 'My Real Name';
	

	# Fazer um FOR aqui para adicionar todos os destinatários

	# Verifica quantidade de destinatários
	$rows = $recipients['rows'];

	# Retira array contendo os funcionários
	$staff = $recipients['staff'];

	# Varre o array bidimensional adicionando os destinatários do email
	for($i=1; $i<=$rows; $i++) {
		$mailto = $staff[$i]['fun_email'];
		$mail->addAddress($mailto);  // Add a recipient
	}

	# Guardar estes para uso posterior
	//$mail->addCC('girol@ffclrp.usp.br');
	//$mail->addBCC('bcc@example.com');

	$mail->WordWrap = 50;                                 	// Set word wrap to 50 characters

	# Exemplos da função phpMailer. Para uso posterior
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Nova ordem de serviço - Nr.'. $id_os;

	$mail->Body    = '<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							<meta http-equiv="content-type" content="text/html; charset=utf-8" />
							</head>
							<body>
								Nova solicita&ccedil;&atilde;o aberta na '. $show_workshop . "
								<br />
								<br />
								Para ver a solicita&ccedil;&atilde;o acesse o link:
								".	$url_os ."consulta_pedido.php?id_os=$id_os

							</body>
							</html>"
								;


	# configurar posteriormente
	//$mail->AltBody = 'Texto sem ser HTML';

	# Debug
	//$mail->SMTPDebug = 1;

	if(!$mail->send()) {
	   echo 'Email não pôde ser enviado';
	   echo 'O erro encontrado foi: ' . $mail->ErrorInfo;
	   exit;
	}

	//echo 'Notificação enviada com sucesso via email.';

}
#########################################
# Função para debugar variáveis
#########################################

# Parâmetros:
# - Variável para debugar = $var
# - Var Dump = v
# - Print_r = p

function debug_var($var,$varname, $debug_type='v') {
	echo "Debugando: " . '<span style="color:red;">' . $varname . "</span>";
	echo "<pre>";
	
	if($debug_type=='v') {
		var_dump($var);
	}
	
	if($debug_type=='p') {
		print_r($var);
	}
	echo "</pre>";
}
################################################################
# Função para preparar variáveis recebidas ou retiradas do POST
################################################################

function test_input($data) {
	$data = trim($data);
   $data = addslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

##############################################################
# Limpa as slashes antes de mostrar ao usuário
##############################################################
function clean_output($data) {
	$data = stripslashes($data);
	return $data;
}

##############################################################
# Verifica os técnicos de cada oficina e o docente responsável
# Retorna dados de envio para email
##############################################################

function retrieve_staff($id_oficina) {
	
	# ID da oficina está localizado no banco
	# Atualmente:
	# 1 - Oficina Mecânica
	# 2 - Oficina de Eletrônica

	# Tipos de Usuários:
	# 1 - Funcionário padrão
	# 2 - Técnico responsável
	# 3 - Docente responsável

	# Transação padrão no banco de dados

	# cria um array para armazenar os dados

	$query = "SELECT fun_id, fun_nome, fun_email, fun_tipo FROM funcionario WHERE fun_tipo IN(2,3) AND fun_ativo=1 AND fun_tipo_oficina = $id_oficina ORDER BY fun_tipo DESC";
	$result = mysql_query($query) or die ("Ocorreu um erro -> " . mysql_error());

	# Verifica quantidade de linhas
	$rows = mysql_num_rows($result);

	# Armazena num array associativo
	$staff_and_rows['rows'] = $rows;

	# Transforma o resultado do banco num array bidimensional
	while( $dados = mysql_fetch_assoc($result) ){
		foreach ($dados as $chave => $valor){
			$array_dados[$rows][$chave] = $valor;
		}
		$rows--;
	};

	# Retorna um array com o número de linhas e com os dados do banco
	$staff_and_rows['staff'] = $array_dados;
	return $staff_and_rows;


}
?>

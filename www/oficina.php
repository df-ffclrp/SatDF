<?php
# Inclui o cabecalho html padrao
include ('includes/header.html');

# Funções
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
			
			$query = "SELECT * FROM funcionario WHERE fun_num_usp = '$num_usp' AND fun_ativo = 1";

         # Conecta ao banco
			$conexao = conectaDB();

        	# Envia consulta ao banco
			$result = mysqli_query($conexao , $query) or die ('deu pau na query');
			
			# Verifica quantas linhas foram encontradas na query
         $linha = mysqli_num_rows( $result );
         
			# Testa resultado retirado da query
			if ($linha == 1 ){
				
				# Inicia sessão para armazenar dados do usuário
				session_start();
					
				# Retira dados do array da query
				$array_result =	mysqli_fetch_assoc($result);
				
				# Retira Variaveis do array e transforma em variaveis de sessao:
				$_SESSION['fun_id']			= $array_result['fun_id'];
				$_SESSION['num_usp'] 		= $array_result['fun_num_usp'];
				$_SESSION['nome']    		= $array_result['fun_nome'];
				$_SESSION['ramal'] 			= $array_result['fun_ramal'];
				$_SESSION['email']			= $array_result['fun_email'];
				$_SESSION['tipo_oficina']	= $array_result['fun_tipo_oficina'];

				#armazena destino da oficina na variável de Sessão
				$_SESSION['oficina_destino'] = $oficina_destino;

				# Finaliza a conexão e manda pra próxima página:

				mysqli_close($conexao);
				header('location:processa_pedido.php');
				exit();
				
				}

			else {
				$erro = "Número USP inválido ou não cadastrado. Solicite o cadastramento no ramal 0077";
			}
	}
}
?>

	<div class="conteudo">
        <div class="titulo">
				<img src="img/wrench.png"/><h1> Serviço de Atendimento Técnico</h1>

        </div>
      <?php
			# mostra mensagem de erro caso haja erros no processamento
			if (isset($erro)){
				echo '<p id="erro">'.$erro.'</p>';
			}

		?>
			<div class="box_login">
				<form action="oficina.php" method="post">

				<p>Número USP</p> 
             	<input type="text" name="num_usp" size="20" maxlenght="10" required="required" pattern="[0-9]+$" title="Insira somente números">

				<p>Área de atendimento</p>
					<select name="oficina_destino">
						<option value="1" selected>Oficina Mecânica</option>
						<option value="2">Oficina de Eletrônica</option>
					</select>

                <br/>
                <input class="botao" type="submit" name="enviar" value="Enviar Dados">
            </form>
        </div>
	</div>


<!-- end page -->
</body>
</html>

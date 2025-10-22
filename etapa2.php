<?php
session_start();
$erro_validacao = 0;

$erro_nome = $erro_email = $erro_genero = $erro_data_nascimento = $erro_cpf = "";
$erro_telefone = $erro_cep = $erro_endereco = $erro_cidade = $erro_estado = "";

if (isset($_POST["botao"])) {
	// 1. Armazena os dados na sessão
	$_SESSION["nome"] = $_POST["nome"] ?? "";
	$_SESSION["email"] = $_POST["email"] ?? "";
	$_SESSION["genero"] = $_POST["genero"] ?? "";
	$_SESSION["data-nascimento"] = $_POST["data-nascimento"] ?? "";
	$_SESSION["cpf"] = $_POST["cpf"] ?? "";
	$_SESSION["telefone"] = $_POST["telefone"] ?? "";
	$_SESSION["cep"] = $_POST["cep"] ?? "";
	$_SESSION["endereco"] = $_POST["endereco"] ?? "";
	$_SESSION["cidade"] = $_POST["cidade"] ?? "";
	$_SESSION["estado"] = $_POST["estado"] ?? "";

	// 2. Validações para todos os 10 campos
	// Validação: NOME
	if (empty($_SESSION["nome"]) || !preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/", $_SESSION["nome"])) {
		$erro_nome = "<span style='color:red'>Preencha o nome corretamente.</span>";
		$erro_validacao++;
	}

	// Validação: EMAIL
	if (empty($_SESSION["email"]) || !filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
		$erro_email = "<span style='color:red'>Preencha o e-mail corretamente.</span>";
		$erro_validacao++;
	}

	// Validação: GÊNERO
	if (empty($_SESSION["genero"])) {
		$erro_genero = "<span style='color:red'>Selecione um gênero.</span>";
		$erro_validacao++;
	}

	// Validação: DATA DE NASCIMENTO
	if (empty($_SESSION["data-nascimento"])) {
		$erro_data_nascimento = "<span style='color:red'>Preencha a data de nascimento.</span>";
		$erro_validacao++;
	}

	// Validação: CPF
	if (empty($_SESSION["cpf"]) || !preg_match("/^\d{3}\.\d{3}\.\d{3}-\d{2}$/", $_SESSION["cpf"])) {
		$erro_cpf = "<span style='color:red'>Preencha o CPF no formato correto.</span>";
		$erro_validacao++;
	}

	// Validação: TELEFONE
	if (empty($_SESSION["telefone"]) || !preg_match("/^\(\d{2}\) \d{4,5}-\d{4}$/", $_SESSION["telefone"])) {
		$erro_telefone = "<span style='color:red'>Preencha o telefone no formato correto.</span>";
		$erro_validacao++;
	}

	// Validação: CEP
	if (empty($_SESSION["cep"]) || !preg_match("/^\d{5}-\d{3}$/", $_SESSION["cep"])) {
		$erro_cep = "<span style='color:red'>Preencha o CEP no formato correto.</span>";
		$erro_validacao++;
	}

	// Validação: ENDEREÇO
	if (empty($_SESSION["endereco"])) {
		$erro_endereco = "<span style='color:red'>Preencha o endereço.</span>";
		$erro_validacao++;
	}

	// Validação: CIDADE
	if (empty($_SESSION["cidade"])) {
		$erro_cidade = "<span style='color:red'>Preencha a cidade.</span>";
		$erro_validacao++;
	}

	// Validação: ESTADO
	if (empty($_SESSION["estado"]) || strlen($_SESSION["estado"]) != 2) {
		$erro_estado = "<span style='color:red'>Preencha o estado com a sigla de 2 letras.</span>";
		$erro_validacao++;
	}

	// 3. Verifica se houve erros e redireciona
	if ($erro_validacao == 0) {
		header("Location: etapa3.php");
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<style>
		.capa-hq {
			width: 250px;
			height: 250px;
			object-fit: contain;
		}

		.alinhamento-flex {
			display: flex;
			justify-content: center;
		}

		.container-tabela {
			display: flex;
			justify-content: center;
		}

		body {
			font-family: Arial, sans-serif;
			margin-left: 3cm;
			margin-right: 2cm;
			margin-top: 3cm;
			margin-bottom: 2cm;
			line-height: 1.5;
		}

		.paragrafo-abnt {
			text-align: justify;
			text-indent: 1.25cm;
			line-height: 1.5;
		}

		.logo-ditcomics {
			width: 300px;
			height: auto;
		}

		footer {
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 20px 0;
		}

		.link-com-imagem {
			display: flex;
			flex-direction: column;
			align-items: center;
			text-decoration: none;
			color: #333;
			font-weight: bold;
		}

		.icone-compra {
			width: 50px;
			height: auto;
			margin-bottom: 5px;
		}

		.form-container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 8px;
		}

		form label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		form input,
		form select {
			width: calc(100% - 12px);
			padding: 8px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}

		form button {
			width: 100%;
			padding: 10px;
			background-color: #333;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
			margin-bottom: 10px;
		}

		form button:hover {
			background-color: #555;
		}

		.erro-msg {
			color: red;
			margin-bottom: 10px;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/styles.css">
	<title>DADOS DO CLIENTE</title>
</head>

<body>
	<header>
		<div style="text-align:center;">
			<img src="LOGODITCOMICS.png" alt="DITCOMICS" class="logo-ditcomics">
		</div>
	</header>
	<main>
		<section class="form-container">
			<h2>Primeiro, vamos preencher seus dados</h2>
			<form action="etapa2.php" method="post">
				<label for="nome">Nome Completo:</label>
				<input type="text" id="nome" name="nome" placeholder="Seu nome completo" maxlength="100"
					value="<?php echo htmlspecialchars($_SESSION["nome"] ?? ''); ?>">
				<?php echo $erro_nome; ?>

				<label for="email">E-mail:</label>
				<input type="email" id="email" name="email" placeholder="exemplo@dominio.com"
					value="<?php echo htmlspecialchars($_SESSION["email"] ?? ''); ?>">
				<?php echo $erro_email; ?>

				<label for="genero">Gênero:</label>
				<select id="genero" name="genero">
					<option value="" <?php echo ($_SESSION["genero"] ?? '') == '' ? 'selected' : ''; ?>>Selecione...
					</option>
					<option value="masculino" <?php echo ($_SESSION["genero"] ?? '') == 'masculino' ? 'selected' : ''; ?>>
						Masculino</option>
					<option value="feminino" <?php echo ($_SESSION["genero"] ?? '') == 'feminino' ? 'selected' : ''; ?>>
						Feminino</option>
					<option value="nao-binario" <?php echo ($_SESSION["genero"] ?? '') == 'nao-binario' ? 'selected' : ''; ?>>Não Binário</option>
					<option value="prefiro-nao-dizer" <?php echo ($_SESSION["genero"] ?? '') == 'prefiro-nao-dizer' ? 'selected' : ''; ?>>Prefiro não dizer</option>
				</select>
				<?php echo $erro_genero; ?>

				<label for="data-nascimento">Data de Nascimento:</label>
				<input type="date" id="data-nascimento" name="data-nascimento"
					value="<?php echo htmlspecialchars($_SESSION["data-nascimento"] ?? ''); ?>">
				<?php echo $erro_data_nascimento; ?>

				<label for="cpf">CPF:</label>
				<input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14"
					value="<?php echo htmlspecialchars($_SESSION["cpf"] ?? ''); ?>">
				<?php echo $erro_cpf; ?>

				<label for="telefone">Telefone:</label>
				<input type="tel" id="telefone" name="telefone" placeholder="(99) 99999-9999" maxlength="15"
					value="<?php echo htmlspecialchars($_SESSION["telefone"] ?? ''); ?>">
				<?php echo $erro_telefone; ?>

				<label for="cep">CEP:</label>
				<input type="text" id="cep" name="cep" placeholder="00000-000" maxlength="9"
					value="<?php echo htmlspecialchars($_SESSION["cep"] ?? ''); ?>">
				<?php echo $erro_cep; ?>

				<label for="endereco">Endereço:</label>
				<input type="text" id="endereco" name="endereco" placeholder="Rua, Número, Bairro" maxlength="200"
					value="<?php echo htmlspecialchars($_SESSION["endereco"] ?? ''); ?>">
				<?php echo $erro_endereco; ?>

				<label for="cidade">Cidade:</label>
				<input type="text" id="cidade" name="cidade"
					value="<?php echo htmlspecialchars($_SESSION["cidade"] ?? ''); ?>">
				<?php echo $erro_cidade; ?>

				<label for="estado">Estado:</label>
				<input type="text" id="estado" name="estado" maxlength="2"
					value="<?php echo htmlspecialchars($_SESSION["estado"] ?? ''); ?>">
				<?php echo $erro_estado; ?>

				<button type="submit" name="botao">prosseguir</button>
			</form>
		</section>
	</main>
	<footer>
		<a href="etapa3.php" class="link-com-imagem">
			<img src="https://images.vexels.com/media/users/3/200097/isolated/preview/942820836246f08c2d6be20a45a84139-carrinho-de-compras-icon-carrinho-de-compras.png"
				alt="Ícone de Carrinho de Compras" class="icone-compra">
			Compra de Produtos
		</a>
	</footer>
</body>

</html>
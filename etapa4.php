<?php
session_start();
$erro_validacao = 0;

$erro_pagamento = "";
$erro_frete = "";

if (isset($_POST["botao"])) {
	// Armazena os dados na sessão
	$_SESSION["pagamento_selecionado"] = $_POST["pagamento_selecionado"] ?? "";
	$_SESSION["frete_selecionado"] = $_POST["frete_selecionado"] ?? "";

	// 1. Validação da Forma de Pagamento (select/option)
	if (empty($_SESSION["pagamento_selecionado"])) {
		$erro_pagamento = "<span style='color:red'>Selecione uma forma de pagamento.</span>";
		$erro_validacao++;
	}

	// 2. Validação do Frete (radio)
	if (empty($_SESSION["frete_selecionado"])) {
		$erro_frete = "<span style='color:red'>Selecione uma opção de frete.</span>";
		$erro_validacao++;
	}

	// Se não houver erros, vai para a próxima página
	if ($erro_validacao == 0) {
		header("Location: confirma.php");
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
		form select,
		form .radio-group,
		form .checkbox-group {
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
			display: block;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		th,
		td {
			padding: 10px;
			border: 1px solid #ccc;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/styles.css">
	<title>FINALIZAR COMPRA</title>
</head>

<body>
	<header>
		<div style="text-align:center;">
			<img src="LOGODITCOMICS.png" alt="DITCOMICS" class="logo-ditcomics">
		</div>
	</header>
	<main>
		<section class="form-container">
			<h2>Forma de Pagamento e Frete</h2>
			<form action="etapa4.php" method="post">
				<label for="pagamento">Forma de Pagamento:</label>
				<select id="pagamento" name="pagamento_selecionado">
					<option value="">Selecione...</option>
					<option value="1" <?php echo ($_SESSION["pagamento_selecionado"] ?? '') == '1' ? 'selected' : ''; ?>>À
						vista - 9% de desconto</option>
					<option value="2" <?php echo ($_SESSION["pagamento_selecionado"] ?? '') == '2' ? 'selected' : ''; ?>>A
						prazo - 11% de acréscimo</option>
					<option value="3" <?php echo ($_SESSION["pagamento_selecionado"] ?? '') == '3' ? 'selected' : ''; ?>>
						3x no cartão - 15% de acréscimo</option>
				</select>
				<?php echo $erro_pagamento; ?>

				<label>Opções de Frete:</label>
				<div class="radio-group">
					<input type="radio" id="frete1" name="frete_selecionado" value="frete_comum" <?php echo ($_SESSION["frete_selecionado"] ?? '') == 'frete_comum' ? 'checked' : ''; ?>>
					<label for="frete1">Frete Comum</label>
					<br>
					<input type="radio" id="frete2" name="frete_selecionado" value="frete_expresso" <?php echo ($_SESSION["frete_selecionado"] ?? '') == 'frete_expresso' ? 'checked' : ''; ?>>
					<label for="frete2">Frete Expresso</label>
					<br>
					<input type="radio" id="frete3" name="frete_selecionado" value="retirada" <?php echo ($_SESSION["frete_selecionado"] ?? '') == 'retirada' ? 'checked' : ''; ?>>
					<label for="frete3">Retirada na loja</label>
				</div>
				<?php echo $erro_frete; ?>

				<button type="submit" name="botao">prosseguir</button>
			</form>
		</section>
	</main>
	<footer>
		<a href="etapa3.php" class="link-com-imagem">
			<button>Voltar</button>
		</a>
	</footer>
</body>

</html>
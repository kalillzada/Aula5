<?php
session_start();
$erro_validacao = 0;

$erro_quadrinho = "";
$erro_quantidade = "";
$erro_embalagem = "";
$erro_frete = "";

if (isset($_POST["botao"])) {
	// Armazena os dados na sessão
	$_SESSION["quadrinho_selecionado"] = $_POST["quadrinho_selecionado"] ?? "";
	$_SESSION["quantidade"] = $_POST["quantidade"] ?? "";
	$_SESSION["embalagem"] = $_POST["embalagem"] ?? "";
	$_SESSION["frete"] = $_POST["frete"] ?? "";

	// 1. Validação do Quadrinho (select/option)
	if (empty($_SESSION["quadrinho_selecionado"])) {
		$erro_quadrinho = "<span style='color:red'>Selecione um quadrinho.</span>";
		$erro_validacao++;
	}

	// 2. Validação da Quantidade (input text)
	$qtdade = (int) ($_SESSION["quantidade"] ?? 0);
	if ($qtdade < 1) {
		$erro_quantidade = "<span style='color:red'>Preencha a quantidade.</span>";
		$erro_validacao++;
	} elseif ($qtdade > 4) {
		$erro_quantidade = "<span style='color:red'>Limite de 4 unidades por quadrinho excedido.</span>";
		$erro_validacao++;
	}

	// 3. Validação da Embalagem (radio)
	if (empty($_SESSION["embalagem"])) {
		$erro_embalagem = "<span style='color:red'>Selecione a embalagem.</span>";
		$erro_validacao++;
	}

	// 4. Validação do Frete (checkbox)
	if (empty($_SESSION["frete"])) {
		$erro_frete = "<span style='color:red'>Selecione uma opção de frete.</span>";
		$erro_validacao++;
	}

	// Se não houver erros, vai para a próxima página
	if ($erro_validacao == 0) {
		header("Location: etapa4.php");
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
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/styles.css">
	<title>VENDA DE QUADRINHOS</title>
</head>

<body>
	<header>
		<div style="text-align:center;">
			<img src="LOGODITCOMICS.png" alt="DITCOMICS" class="logo-ditcomics">
		</div>
	</header>
	<main>
		<section class="form-container">
			<h2>Escolha seu Quadrinho</h2>
			<form action="etapa3.php" method="post">
				<label for="quadrinho">Quadrinho:</label>
				<select id="quadrinho" name="quadrinho_selecionado">
					<option value="">Selecione um quadrinho...</option>
					<option value="1" <?php echo ($_SESSION["quadrinho_selecionado"] ?? '') == '1' ? 'selected' : ''; ?>>
						Batman: Ano Um - R$ 78,00</option>
					<option value="2" <?php echo ($_SESSION["quadrinho_selecionado"] ?? '') == '2' ? 'selected' : ''; ?>>
						Superman: Entre a Foice e o Martelo - R$ 65,00</option>
					<option value="3" <?php echo ($_SESSION["quadrinho_selecionado"] ?? '') == '3' ? 'selected' : ''; ?>>
						Homem-Aranha: A última caçada de Kraven - R$ 125,00</option>
					<option value="4" <?php echo ($_SESSION["quadrinho_selecionado"] ?? '') == '4' ? 'selected' : ''; ?>>
						Demolidor: A Queda de Murdock - R$ 56,00</option>
				</select>
				<?php echo $erro_quadrinho; ?>

				<label for="quantidade">Quantidade:</label>
				<input type="text" id="quantidade" name="quantidade" size="1" maxlength="1"
					value="<?php echo htmlspecialchars($_SESSION["quantidade"] ?? ''); ?>">
				<?php echo $erro_quantidade; ?>

				<label>Embalagem:</label>
				<div class="radio-group">
					<input type="radio" id="padrao" name="embalagem" value="padrao" <?php echo ($_SESSION["embalagem"] ?? '') == 'padrao' ? 'checked' : ''; ?>>
					<label for="padrao">Padrão</label>

					<input type="radio" id="presente" name="embalagem" value="presente" <?php echo ($_SESSION["embalagem"] ?? '') == 'presente' ? 'checked' : ''; ?>>
					<label for="presente">Para presente</label>
				</div>
				<?php echo $erro_embalagem; ?>

				<label>Opções de Frete:</label>
				<div class="checkbox-group">
					<input type="checkbox" id="frete_comum" name="frete[]" value="comum" <?php echo (in_array('comum', $_SESSION["frete"] ?? [])) ? 'checked' : ''; ?>>
					<label for="frete_comum">Frete Comum</label>
					<br>
					<input type="checkbox" id="frete_expresso" name="frete[]" value="expresso" <?php echo (in_array('expresso', $_SESSION["frete"] ?? [])) ? 'checked' : ''; ?>>
					<label for="frete_expresso">Frete Expresso</label>
				</div>
				<?php echo $erro_frete; ?>

				<button type="submit" name="botao">prosseguir</button>
			</form>
		</section>
	</main>
	<footer>
		<a href="etapa4.php" class="link-com-imagem">
			<img src="https://images.vexels.com/media/users/3/200097/isolated/preview/942820836246f08c2d6be20a45a84139-carrinho-de-compras-icon-carrinho-de-compras.png"
				alt="Ícone de Carrinho de Compras" class="icone-compra">
				Opções de Pagamento
			<button>Voltar</button>
		</a>
	</footer>
</body>

</html>
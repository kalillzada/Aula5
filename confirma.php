<?php
session_start();

// Verificando se os dados necessários estão na sessão
if (!isset($_SESSION['quadrinho_selecionado']) || !isset($_SESSION['pagamento_selecionado'])) {
    // Se faltarem dados, redireciona para o início do fluxo de compra
    header("Location: index5.php");
    exit;
}

// 1. Dados do Cliente
$nome = $_SESSION["nome"] ?? 'Não informado';
$email = $_SESSION["email"] ?? 'Não informado';
$genero_id = $_SESSION["genero"] ?? '';
$genero = ($genero_id == 'masculino') ? "Masculino" : (($genero_id == 'feminino') ? "Feminino" : "Não informado");
$cpf = $_SESSION["cpf"] ?? 'Não informado';
$telefone = $_SESSION["telefone"] ?? 'Não informado';
$endereco = $_SESSION["endereco"] ?? 'Não informado';
$cidade = $_SESSION["cidade"] ?? 'Não informada';
$estado = $_SESSION["estado"] ?? 'Não informado';

// 2. Dados da Compra
$quadrinho_id = $_SESSION["quadrinho_selecionado"] ?? '';
$quantidade = $_SESSION["quantidade"] ?? 0;
$embalagem = $_SESSION["embalagem"] ?? 'Não informada';

// Mapeamento dos quadrinhos para obter nome e preço
$quadrinhos = [
	'1' => ['nome' => 'Batman: Ano Um', 'preco' => 78.00],
	'2' => ['nome' => 'Superman: Entre a Foice e o Martelo', 'preco' => 65.00],
	'3' => ['nome' => 'Homem-Aranha: A última caçada de Kraven', 'preco' => 125.00],
	'4' => ['nome' => 'Demolidor: A Queda de Murdock', 'preco' => 56.00]
];
$quadrinho_nome = $quadrinhos[$quadrinho_id]['nome'] ?? 'Não selecionado';
$quadrinho_preco = $quadrinhos[$quadrinho_id]['preco'] ?? 0;
$subtotal_produtos = $quadrinho_preco * $quantidade;

// 3. Dados de Pagamento e Frete
$pagamento_id = $_SESSION["pagamento_selecionado"] ?? '';
$frete_id = $_SESSION["frete_selecionado"] ?? '';

// Mapeamento das formas de pagamento para obter nome e taxa
$pagamentos = [
	'1' => ['nome' => 'À vista (9% de desconto)', 'taxa' => -0.09],
	'2' => ['nome' => 'A prazo (11% de acréscimo)', 'taxa' => 0.11],
	'3' => ['nome' => '3x no cartão (15% de acréscimo)', 'taxa' => 0.15]
];
$pagamento_nome = $pagamentos[$pagamento_id]['nome'] ?? 'Não selecionado';
$taxa_pagamento = $pagamentos[$pagamento_id]['taxa'] ?? 0;
$subtotal_com_taxa = $subtotal_produtos + ($subtotal_produtos * $taxa_pagamento);

// Mapeamento do frete para obter nome e valor
$fretes = [
	'frete_comum' => ['nome' => 'Frete Comum', 'valor' => 10.00],
	'frete_expresso' => ['nome' => 'Frete Expresso', 'valor' => 25.00],
	'retirada' => ['nome' => 'Retirada na loja', 'valor' => 0.00]
];
$frete_nome = $fretes[$frete_id]['nome'] ?? 'Não selecionado';
$frete_valor = $fretes[$frete_id]['valor'] ?? 0;

// Cálculo do valor final
$valor_final_compra = $subtotal_com_taxa + $frete_valor;
$valor_parcelado = ($pagamento_id == '3') ? $valor_final_compra / 3 : 0;
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
	<title>CONFIRMAÇÃO DO PEDIDO</title>
</head>

<body>
	<header>
		<div style="text-align:center;">
			<img src="LOGODITCOMICS.png" alt="DITCOMICS" class="logo-ditcomics">
		</div>
	</header>
	<main>
		<section class="form-container">
			<h2>Confirmação do Pedido</h2>
			<p>Por favor, revise os seus dados e informações da compra antes de finalizar.</p>

			<table>
				<tr>
					<th colspan="2">Dados do Cliente</th>
				</tr>
				<tr>
					<td>Nome:</td>
					<td><?php echo htmlspecialchars($nome); ?></td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td><?php echo htmlspecialchars($email); ?></td>
				</tr>
				<tr>
					<td>Gênero:</td>
					<td><?php echo htmlspecialchars($genero); ?></td>
				</tr>
				<tr>
					<td>CPF:</td>
					<td><?php echo htmlspecialchars($cpf); ?></td>
				</tr>
				<tr>
					<td>Telefone:</td>
					<td><?php echo htmlspecialchars($telefone); ?></td>
				</tr>
				<tr>
					<td>Endereço:</td>
					<td><?php echo htmlspecialchars($endereco); ?></td>
				</tr>
				<tr>
					<td>Cidade/Estado:</td>
					<td><?php echo htmlspecialchars($cidade . '/' . $estado); ?></td>
				</tr>
				<tr>
					<th colspan="2">Detalhes da Compra</th>
				</tr>
				<tr>
					<td>Quadrinho:</td>
					<td><?php echo htmlspecialchars($quadrinho_nome); ?></td>
				</tr>
				<tr>
					<td>Quantidade:</td>
					<td><?php echo htmlspecialchars($quantidade); ?></td>
				</tr>
				<tr>
					<td>Preço Unitário:</td>
					<td>R$ <?php echo number_format($quadrinho_preco, 2, ',', '.'); ?></td>
				</tr>
				<tr>
					<td>Embalagem:</td>
					<td><?php echo htmlspecialchars($embalagem); ?></td>
				</tr>
				<tr>
					<th colspan="2">Valores e Pagamento</th>
				</tr>
				<tr>
					<td>Subtotal dos Produtos:</td>
					<td>R$ <?php echo number_format($subtotal_produtos, 2, ',', '.'); ?></td>
				</tr>
				<tr>
					<td>Forma de Pagamento:</td>
					<td><?php echo htmlspecialchars($pagamento_nome); ?></td>
				</tr>
				<tr>
					<td>Subtotal com Pagamento:</td>
					<td>R$ <?php echo number_format($subtotal_com_taxa, 2, ',', '.'); ?></td>
				</tr>
				<tr>
					<td>Frete:</td>
					<td><?php echo htmlspecialchars($frete_nome); ?> (R$ <?php echo number_format($frete_valor, 2, ',', '.'); ?>)</td>
				</tr>
				<tr>
					<td>**VALOR TOTAL FINAL:**</td>
					<td>**R$ <?php echo number_format($valor_final_compra, 2, ',', '.'); ?>**</td>
				</tr>
				<?php if ($valor_parcelado > 0) : ?>
					<tr>
						<td>Valor Parcelado (3x):</td>
						<td>R$ <?php echo number_format($valor_parcelado, 2, ',', '.'); ?></td>
					</tr>
				<?php endif; ?>
			</table>
			<br>
			<a href="index5.php"><button>Finalizar Compra</button></a>
		</section>
	</main>
	<footer>
		<a href="etapa4.php" class="link-com-imagem">
			<button>Voltar</button>
		</a>
	</footer>
</body>

</html>
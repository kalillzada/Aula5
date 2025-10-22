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
        display: flex; /* Define o container como flexível */
        justify-content: center; /* Centraliza o conteúdo horizontalmente */
        }

        body {
            font-family: comic sans MS, cursive;
            margin-left: 3cm;
            margin-right: 2cm;
            margin-top: 3cm;
            margin-bottom: 2cm;
        }

        .paragrafo-abnt {
        margin-top: 0cm;
        margin-bottom: 0cm;
        text-indent: 1.25cm;
        text-align: justify;
        line-height: 1.5;
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

        .logo-ditcomics {
        width: 300px;
        height: auto;
        }

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">
    <title>
        DITCOMICS
    </title>
</head>
<body>
    <header>
        <div style="text-align:center;"> <img src="LOGODITCOMICS.png" alt="DITCOMICS" class="logo-ditcomics">
        </div>
    </header>
    <main>
        <section id="intro">
            <h3 style ="text-align:center">Atividade Leandro</h3>
            <p  class="paragrafo-abnt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A sua loja centenária de quadrinhos
                aora com sede em Bauru-SP, trazendo uma coletânea de mais de 15mil 
                revistas, quadrinhos e mangás dos mais antigos aos mais recentes.
            </p>
            <p  class="paragrafo-abnt"">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Da era de ouro até as 
                adaptações para o cinema, as revistas em quadrinhos se 
                tornaram um pilar da cultura popular que molda o 
                imaginário de várias gerações. O surgimento dos 
                quadrinhos remonta ao final do século 19, com a 
                publicação de tiras de jornal, mas foi na década 
                de 1930 que o formato de revista com histórias de 
                super-heróis começou a se popularizar com a criação do 
                Superman. No entanto, foi nas décadas seguintes, 
                com o advento da Marvel Comics e a introdução de 
                personagens como o Homem-Aranha e os Vingadores, que 
                os quadrinhos começaram a ganhar maior reconhecimento 
                e a abordar temas mais complexos. A popularidade de 
                editoras como a DC Comics e a Marvel ajudou a construir 
                um universo compartilhado, o que gerou uma base de fãs 
                global e despertou interesse por essa forma de arte. 
                A ascensão do cinema e a produção de filmes de grande 
                sucesso baseados em super-heróis permitiram que pessoas 
                ao redor do mundo tivessem acesso a uma vasta gama de 
                narrativas e personagens.
            </p>
        </section>
        <section id="comic-list">
            <h2 style ="text-align:center">Gigantes dos quadrinhos</h2>
            <div class="container-tabela">
                <table>
                    <tr class="alinhamento-flex">
                        <td>
                            <img src="https://imusic.b-cdn.net/images/item/original/257/9781779527257.jpg?grant-morrison-2024-all-star-superman-dc-compact-comics-edition-paperback-book&class=scaled&v=1709625388" alt="Superman All-Star" class="capa-hq">
                        </td>
                        <td>
                            <img src="https://livrariacultura.vteximg.com.br/arquivos/ids/124882705-1000-1000/2517555.jpg?v=637991306719030000" alt="Batman: O Longo Dia das Bruxas" class="capa-hq">
                        </td>
                        <td>
                            <img src="https://www.americanas.com.br/_next/image?url=https%3A%2F%2Famericanas.vtexassets.com%2Farquivos%2Fids%2F26385196%2F1259502448_1SZ.jpg%3Fv%3D638755541413500000&w=768&q=90" alt="Homem-Aranha: Azul" class="capa-hq">
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <section id="outro">
            <p class="paragrafo-abnt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se você também é um entusiasta 
                de quadrinhos, veio ao lugar certo! Nossa página é um santuário 
                virtual dedicado a todos os apaixonados por essa forma única 
                de arte. Aqui, mergulharemos juntos em um universo de narrativas 
                épicas, personagens icônicos e estilos de desenho que vão 
                despertar sua imaginação.
            </p>

            <p class="paragrafo-abnt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Explore nossa coleção cuidadosamente selecionada de resenhas, 
            recomendações e análises aprofundadas das sagas e heróis mais 
            marcantes. Quer você seja um novato curioso ou um veterano experiente, 
            estamos aqui para compartilhar nossa paixão e conhecimento sobre o 
            universo dos quadrinhos de super-heróis.
            </p>
        </section>
    </main>

    <footer>
        <a href="etapa2.php" class="link-com-imagem">
            <img src="https://images.vexels.com/media/users/3/200097/isolated/preview/942820836246f08c2d6be20a45a84139-carrinho-de-compras-icon-carrinho-de-compras.png" alt="Ícone de Carrinho de Compras" class="icone-compra">
            Compra de Produtos
        </a>
    </footer>
</body>
</html>
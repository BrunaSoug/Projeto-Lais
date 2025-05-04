<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siga Verba - Emendas Parlamentares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Noto+Serif&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="padrao">
    <?php include 'navbar.php'; ?>
    <div style=" margin-left: 100px; margin-top: 20px; margin-right: 140px">
        <div
            style="margin-top: 20px; margin-left: 320px; display: flex; justify-content: space-between; align-items: center;">
            <img src="img/icone-lais.png" alt="Lais" class="img-fluid" style="max-width: 8%; object-fit: contain;">
        </div>
        <div class="container-principal">
            <div class="mb-2 text-start">
                <h1 class="titulo">O que são emendas parlamentares?</h1>
                <p class="texto-corrido-emendas">
                    Anualmente, o governo federal precisa elaborar o Projeto de Lei Orçamentária Anual (PLOA) que
                    determinará os gastos no ano seguinte. Para dar maior transparência ao processo, o orçamento precisa
                    ser apresentado ao Congresso Nacional, e é nesse momento que podem ser apresentadas as emendas
                    parlamentares.
                </p>
                <p class="texto-corrido-emendas">
                    De acordo com a Constituição, a emenda parlamentar é o instrumento que o Congresso Nacional possui
                    para participar da elaboração do orçamento anual. Elas são uma forma de descentralizar e dar
                    eficiência à alocação dos recursos públicos, afinal, deputados e senadores conhecem mais da
                    realidade de seus estados e regiões do que o governo federal.
                </p>
                <p class="texto-corrido-emendas">
                    Eles podem, então, aperfeiçoar a proposta encaminhada acrescentando novas programações orçamentárias
                    com o objetivo de atender às demandas das comunidades que representam. Ao todo, cada parlamentar tem
                    o direito de apresentar até 25 projetos detalhados de emendas individuais que justifiquem o uso dos
                    recursos.
                </p>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">Sobre a LOA</h1>
                <p class="texto-corrido-emendas">
                    A Lei Orçamentária Anual (LOA) prevê as receitas e fixa as despesas do governo federal para o ano
                    seguinte, indicando quanto será aplicado em cada área e de onde virão os recursos. Entre outros
                    itens, a LOA:
                </p>
                <ul class="lista-emendas" style="list-style-type: disc; padding-left: 20pt;">
                    <li class="texto-corrido mb-2">Projeta parâmetros macroeconômicos, como o Produto Interno Bruto
                        (PIB), a inflação e a taxa de juros;</li>
                    <li class="texto-corrido mb-2">Prevê a arrecadação do governo com tributos e outras fontes de
                        recursos;</li>
                    <li class="texto-corrido mb-2">Define metas para a política fiscal - medidas que o governo toma para
                        equilibrar suas despesas e receitas;</li>
                    <li class="texto-corrido mb-2">Define os valores que a União poderá usar para investimentos e
                        financiamentos, por área;</li>
                    <li class="texto-corrido mb-2">Define despesas determinadas por sentenças judiciais, chamadas
                        precatórios;</li>
                    <li class="texto-corrido">Lista as obras e serviços com indícios de irregularidades graves.</li>
                </ul>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">De onde vem o dinheiro?</h1>
                <p class="texto-corrido-emendas">
                    A verba vem do Orçamento Geral da União (OGU), que é o planejamento financeiro do governo federal
                    para um ano. Esse orçamento é composto por receitas arrecadadas pelo governo, como impostos, taxas e
                    contribuições, e é utilizado para custear as despesas públicas em áreas como saúde, educação,
                    infraestrutura, segurança, entre outras.
                </p>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">Onde as emendas são propostas e avaliadas?</h1>
                <p class="texto-corrido-emendas">
                    Os parlamentares apresentam suas propostas de emendas ao orçamento da mesma maneira que realizam
                    emendas a outros projetos em tramitação no Congresso. Nesse caso, as alterações são feitas ao PLOA.
                    A apresentação das emendas é feita na Comissão Mista de Planos, Orçamentos Públicos e Fiscalização
                    (CMO), que, entre outras funções, é responsável por avaliar o PLOA.
                </p>
                <p class="texto-corrido-emendas">
                    Depois de aprovado na CMO e em sessão plenária conjunta do Congresso, o Orçamento é enviado
                    novamente ao Executivo, para ser sancionado pelo presidente da República, transformando-se,
                    portanto, na LOA.
                </p>
                <p class="texto-corrido-emendas">
                    A CMO é composta por 40 parlamentares, sendo 30 deputados e dez senadores, com igual número de
                    suplentes, e dirigida por um presidente e três vice-presidentes, escolhidos de acordo com a
                    proporcionalidade partidária. No âmbito da CMO, funcionam subcomissões temáticas permanentes, que
                    têm a incumbência de examinar relatórios setoriais sobre orçamento, prioridades e metas da LDO.
                </p>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">Tipos de emenda</h1>
                <ul class="lista-emendas" style="list-style-type: none; padding-top: 20pt;">
                    <li class="texto-corrido mb-2"><strong>Individuais:</strong> É o tipo de emenda de autoria de cada
                        parlamentar, vereador, deputado ou senador.</li>
                    <li class="texto-corrido mb-2"><strong>De bancada:</strong> São emendas coletivas, elaboradas pelas
                        bancadas partidárias que compõem os parlamentos.</li>
                    <li class="texto-corrido mb-2"><strong>De comissão:</strong> Apresentadas pelas comissões técnicas
                        das casas legislativas, bem como pelas suas Mesas Diretoras. Também são emendas coletivas.</li>
                    <li class="texto-corrido mb-2"><strong>De relatoria:</strong> Feitas pelo parlamentar escolhido
                        relator, responsável pelo parecer final do orçamento do ano. Também existem as emendas dos
                        relatores setoriais, que tratam de temas específicos do orçamento.</li>
                </ul>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">Quem fiscaliza os recursos?</h1>
                <p class="texto-corrido-emendas">
                    Os principais órgãos de fiscalização são os Tribunais de Contas — tanto os estaduais e municipais
                    quanto o Tribunal de Contas da União. Também é possível enviar denúncias para outros órgãos de
                    controle, como o Ministério Público e a Polícia Federal.
                </p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
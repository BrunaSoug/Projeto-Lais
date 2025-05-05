<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siga Verba - Dados Selecionados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Noto+Serif&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>


<body class="padrao">
    <?php include 'navbar.php'; ?>
    <div style=" margin-left: 100px; margin-top: 20px;">
        <div
            style="margin-top: 20px; margin-left: 320px; display: flex; justify-content: space-between; align-items: center;  padding-right: 20px;">
            <img src="img/icone-lais.png" alt="Lais" class="img-fluid" style="max-width: 10%; object-fit: contain;">
            <div class="user-box">
                <span>Usuário</span>
                <div class="user-icon-wrapper">
                <img src="img/icone-usuario.png" alt="Usuário" class="user-icon">
                </div>
            </div>
        </div>
        <div class="container-principal">
            <div class="mb-2 text-start">
                <h1 class="titulo">Fonte dos Dados</h1>
                <p class="texto-corrido-emendas">Foram utilizados dados abertos disponibilizados pelo Portal da
                    Transparência do Governo Federal, especificamente o conjunto de "Emendas Parlamentares", que pode
                    ser acessado em:<br>
                    🔗 <a href="https://portaldatransparencia.gov.br/download-de-dados/emendas-parlamentares"
                        target="_blank">https://portaldatransparencia.gov.br/download-de-dados/emendas-parlamentares</a>
                </p>
                <p class="texto-corrido-sem-padding">Essa base contém informações sobre as emendas propostas por
                    parlamentares, incluindo valores, beneficiários, anos de execução, entre outros.</p>
            </div>

            <div class="mb-2 text-start">
                <h1 class="titulo">Modificações Realizadas</h1>
                <p class="texto-corrido-emendas">Para garantir consistência e eficiência na análise, foram diferentes
                    modificações e ajustes na base de dados original:</p>

                <p class="texto-corrido-sem-padding"><strong>Remoção de Parlamentares Sem Nome</strong><br>
                    <span class="motivo">Motivo:</span> Registros sem identificação do parlamentar (campos vazios ou
                    "NÃO INFORMADO") foram excluídos por não agregarem valor informativo à análise.
                </p>

                <p class="texto-corrido-sem-padding"><strong>Redução do Período (De 2010-2024, para
                        2020-2024)</strong><br>
                    <span class="motivo">Motivo:</span> Limitação de capacidade de processamento e foco na análise
                    recente, considerando maior relevância dos últimos 5 anos para o contexto atual.
                </p>

                <p class="texto-corrido-sem-padding"><strong>Seleção Apenas do "Valor Pago"</strong><br>
                    <span class="motivo">Motivo:</span> Simplificação para evitar confusão em modelos do agente LLM,
                    removendo colunas como "Valor Empenhado" ou "Valor Liquidado", que poderiam gerar ambiguidade na
                    interpretação dos dados.
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siga Verba - Equipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Noto+Serif&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="padrao">
    <?php include 'navbar.php'; ?>
    <div class="container-principal" style=" margin-left: 50px; margin-top: 20px;">
        <div style=" margin-left: 50px; margin-top: 20px;">
            <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                <img src="img/icone-lais.png" alt="Lais" class="img-fluid" style="max-width: 8%; object-fit: contain;">
            </div>
            <div class="container-principal"
                style="height: 100vh; padding-left: 0px; padding-right: 150px; margin-top: 125px; background-color: transparent; box-shadow: none; width: 100%; max-width: none;">
                <div style="text-align: left;">
                    <h1 class="titulo">Quem somos?</h1>
                    <p class="texto-corrido">Somos os responsáveis por tornar o Siga Verba possível. Este projeto foi
                        desenvolvido como parte de uma disciplina de Empreendedorismo, por uma equipe multidisciplinar
                        unida pela missão de conectar você a informações públicas de forma <span
                            style="color:var(--cor-destaque);font-weight: bold;">simples</span> e <span
                            style="color:var(--cor-destaque);font-weight: bold;">transparente!</span></p>
                </div>

                <div class="team-gallery">
                    <div class="team-container">
                        <div class="team-member">
                            <img src="img/equipe/foto-bruna.png" alt="Bruna de Souza"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Bruna de Souza</p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Sistemas de
                                    Informação</p>
                            </div>
                        </div>

                        <div class="team-member">
                            <img class="team-member" src="img/equipe/foto-jaderson.png" alt="Jaderson Gonçalves"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Jaderson Gonçalves </p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Design Gráfico
                                </p>
                            </div>
                        </div>
                        <div class="team-member">
                            <img src="img/equipe/foto-matheus.png" alt="Matheus Braga"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Matheus Braga</p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Sistemas de
                                    Informação</p>
                            </div>
                        </div>

                    </div>

                    <div class="team-container">
                        <div class="team-member">
                            <img src="img/equipe/foto-everton.png" alt="Everton França">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Everton França</p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Sistemas de
                                    Informação</p>
                            </div>
                        </div>
                        <div class="team-member">
                            <img src="img/equipe/foto-thais.png" alt="Thais Vaz"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Thais Vaz</p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Design Gráfico
                                </p>
                            </div>
                        </div>
                        <div class="team-member">
                            <img src="img/equipe/foto-daniel.png" alt="Daniel Godoy"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                            <div>
                                <p class="texto-corrido-sem-padding"
                                    style="font-weight: bold; margin: 0; text-align: left;">Daniel Godoy</p>
                                <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Design Gráfico
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="team-container">
                        <div class="team-member">
                            <img src="img/equipe/foto-messias.png" alt="Messias da Silva"
                                style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;"">
    
                                <div>
                                    <p class=" texto-corrido-sem-padding"
                                style="font-weight: bold; margin: 0; text-align: left;">Messias da Silva</p>
                            <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Sistemas de
                                Informação</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <img src="img/equipe/foto-kaylane.png" alt="Kaylane"
                            style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                        <div>
                            <p class="texto-corrido-sem-padding"
                                style="font-weight: bold; margin: 0; text-align: left;">Kaylane Martins </p>
                            <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Design Gráfico</p>
                        </div>
                    </div>

                    <div class="team-member">
                        <img src="img/equipe/foto-caio.png" alt="Caio Dutra"
                            style=" border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                        <div>
                            <p class="texto-corrido-sem-padding"
                                style="font-weight: bold; margin: 0; text-align: left;">Caio Dutra</p>
                            <p class="texto-corrido-sem-padding" style="margin: 0; text-align: left;">Sistemas de
                                Informação</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
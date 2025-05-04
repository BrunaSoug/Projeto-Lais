<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Siga Verba - Início</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .user-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--fonte-principal);
            font-weight: 300;
            color: var(--cinza-usuario);
            font-size: 16px;
        }

        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 4px;
            background-color: var(--cor-branco);
            border: 3px solid var(--cor-branco);
        }

        .apresentacao-lais {
            display: flex;
            align-items: flex-start;
            font-family: var(--fonte-principal);
            font-weight: 300;
            color: var(--cinza-usuario);
            margin-bottom: 30px;
        }

        .apresentacao-lais strong {
            font-weight: 300;
        }

        .apresentacao-lais b {
            font-weight: 400;
            color: var(--cor-branco);
        }

        .lais-avatar {
            width: 36px;
            height: 36px;
            background-color: var(--cor-destaque);
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lais-avatar img {
            width: 140%;
            height: 140%;
            object-fit: cover;
        }

        .user-response {
            text-align: right;
            font-family: var(--fonte-principal);
            font-weight: 300;
            color: var(--cinza-usuario);
            margin-top: 20px;
        }

        .chat-exemplo {
            background-color: var(--azul-claro);
            color: var(--cinza-usuario);
            font-family: var(--fonte-principal);
            font-weight: 300;
            padding: 20px 25px;
            border-radius: 10px;
            display: inline-block;
            max-width: 100%;
        }

        .chat-input-area {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--cor-branco);
            border-radius: 10px;
            padding: 10px 20px;
            max-width: 500px;
            margin: 30px auto;
            gap: 15px;
        }

        .chat-input-area input {
            border: none;
            border-bottom: 1px solid transparent;
            flex: 1;
            outline: none;
            font-size: 16px;
            font-family: var(--fonte-principal);
            font-style: italic;
            color: var(--azul-escuro);
        }

        .chat-input-area input::placeholder {
            color: #999;
            font-style: italic;
        }

        .chat-input-area img {
            width: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body class="padrao">
    <?php include 'navbar.php'; ?>

    <div style="margin-left: 100px; margin-top: 20px;">
        <div
            style="margin-top: 20px; margin-left: 320px; display: flex; justify-content: space-between; align-items: center; padding-right: 20px;">
            <img src="img/icone-lais.png" alt="Lais" class="img-fluid" style="max-width: 10%; object-fit: contain;">
            <div class="user-box">
                <span>Usuário</span>
                <img src="img/icone-usuario.png" alt="Usuário" class="user-icon">
            </div>
        </div>

        <div class="container-principal">
            <div class="apresentacao-lais">
                <div class="lais-avatar">
                    <img src="img/lais_desenho.png" alt="Lais">
                </div>
                <div style="margin-left: 12px;">
                    <p><strong><b>Olá! Eu sou a Lais.</b></strong> Estou aqui para te ajudar a entender melhor como o
                        dinheiro público é usado e o que os parlamentares estão propondo nas leis.</p>
                    <p>Pode me perguntar sobre gastos, projetos de lei, ou até sobre um político específico.</p>
                    <p><strong><b>Quer tentar?</b></strong><br>Você pode dizer, por exemplo: <em>“Qual deputado mais
                            enviou emendas para Campos dos Goytacazes?”</em></p>
                    <p>Sempre que tiver dúvida, é só me chamar. Vamos por partes, no seu tempo.</p>
                </div>
            </div>

            <div id="responses"></div>

            <div id="thinking" style="display: none;" class="apresentacao-lais">
                <div class="lais-avatar">
                    <img src="img/lais_desenho.png" alt="Lais">
                </div>
                <div style="margin-left: -25px; margin-top: -20px;">
                    <img src="img/pensamento.gif" alt="Pensando..." style="height: 80px;">
                </div>
            </div>
            <div class="chat-input-area">
                <img src="img/icone-lupa.png" alt="Buscar" onclick="sendMessage()">
                <input type="text" id="message" placeholder="Pergunte à Lais">
            </div>
        </div>
    </div>

    <script>
        let socket;

        function connectWebSocket() {
            socket = new WebSocket("ws://127.0.0.1:8000/chat");

            socket.onmessage = (event) => {
                const data = JSON.parse(event.data);
                const time = new Date().toLocaleTimeString();
                const responseDiv = document.getElementById("responses");

                if (data.response) {
                    const msg = document.createElement("div");
                    msg.className = "apresentacao-lais";
                    msg.innerHTML = `
                        <div class="lais-avatar">
                            <img src="img/lais_desenho.png">
                        </div>
                         <div style="margin-left: 12px;">
                            <p>${data.response}</p>
                        </div>
                    `;
                    responseDiv.appendChild(msg);
                }

                document.getElementById("thinking").style.display = "none";
            };

            socket.onclose = () => document.getElementById("thinking").style.display = "none";
            socket.onerror = () => document.getElementById("thinking").style.display = "none";
        }

        function sendMessage() {
            const input = document.getElementById("message");
            const message = input.value.trim();
            if (message && socket.readyState === WebSocket.OPEN) {
                const userMsg = document.createElement("div");
                userMsg.className = "d-flex justify-content-end align-items-center gap-2";
                userMsg.style.marginBottom = "25px";
                userMsg.innerHTML = `
                    <div class="chat-exemplo">${message}</div>
                    <div class="user-box">
                        <img src="img/icone-usuario.png" alt="Usuário" class="user-icon">
                    </div>
                `;
                document.getElementById("responses").appendChild(userMsg);

                socket.send(JSON.stringify({ question: message }));
                document.getElementById("thinking").style.display = "flex";
                input.value = "";
            }
        }

        window.onload = connectWebSocket;

        document.getElementById("message").addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.keyCode === 13) {
                event.preventDefault();
                sendMessage();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
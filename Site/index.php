<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot de Transparência</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <style>
        .menu-dropdown {
            background-color: #f1f3f5;
            padding: 5px;
        }

        #offlinePopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #popupContent {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        #popupContent h2 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        #popupContent p {
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .spinner-border {
            margin-top: 15px;
        }

        .closeBtn {
            background-color: #dc3545;
            color: #fff;
            border: 2px solid #c82333;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            width: 100%;
            max-width: 150px;
            margin-top: 20px;
        }

        .closeBtn:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
    <script>
        let socket;

        function connectWebSocket() {
            socket = new WebSocket("ws://127.0.0.1:8000/chat");

            socket.onopen = function () {
                console.log("Conectado ao WebSocket.");
                hideOfflinePopup();
            };

            socket.onmessage = function (event) {
                let data = JSON.parse(event.data);
                let responseDiv = document.getElementById("responses");
                let time = new Date().toLocaleTimeString();

                if (data.response) {
                    responseDiv.innerHTML = `
                <div class="message bot">
                    <b>LIA:</b> ${data.response}
                    <span class="message-time">${time}</span>
                </div>
            ` + responseDiv.innerHTML;
                }

                document.querySelector(".btn-send").disabled = false;
                document.getElementById("thinking").style.display = "none";
            };

            socket.onclose = function (event) {
                console.log("WebSocket fechado. Tentando reconectar...");
                document.querySelector(".btn-send").disabled = false;
                document.getElementById("thinking").style.display = "none";
                showOfflinePopup();
                setTimeout(connectWebSocket, 3000);
            };

            socket.onerror = function (error) {
                console.log("Erro no WebSocket: ", error);
                document.querySelector(".btn-send").disabled = false;
                document.getElementById("thinking").style.display = "none";
//                socket.close();
            };
        }

        function sendMessage() {
            let input = document.getElementById("message");
            let message = input.value.trim();

            if (message && socket.readyState === WebSocket.OPEN) {
                let time = new Date().toLocaleTimeString();
                socket.send(JSON.stringify({
                    question: message
                }));

                let responseDiv = document.getElementById("responses");
                responseDiv.innerHTML = `
            <div class="message user">
                <b>Você:</b> ${message}
                <span class="message-time">${time}</span>
            </div>
        ` + responseDiv.innerHTML;
                input.value = "";

                document.querySelector(".btn-send").disabled = true;
                document.getElementById("thinking").style.display = "block";
            }
        }

        function showOfflinePopup() {
            document.getElementById("offlinePopup").style.display = "flex";
        }

        function hideOfflinePopup() {
            document.getElementById("offlinePopup").style.display = "none";
        }

        function clearConversation() {
            document.getElementById("responses").innerHTML = '';
            document.getElementById("thinking").style.display = 'none';
            document.querySelector(".btn-send").disabled = false;
        }

        window.onload = connectWebSocket;
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><i class="fas fa-comments"></i> Chatbot Transparente</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/"><i class="fas fa-home"></i> Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contato</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_account.php">
                                <i class="fas fa-user-plus"></i> Criar Conta
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div id="offlinePopup">
        <div id="popupContent">
            <h2>O chatbot está offline!</h2>
            <p>Estamos tentando reconectar...</p>
            <div class="spinner-border text-primary" role="status" style="margin: 20px auto; display: block;"></div>
            <button class="closeBtn" onclick="hideOfflinePopup()">Fechar</button>
        </div>
    </div>

    <div class="chat-container">
        <div class="chat-header">
            <h2><i class="fas fa-handshake"></i> Chatbot de Transparência</h2>
        </div>

        <div class="menu-dropdown d-flex justify-content-end">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="chatMenu" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-cog"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="chatMenu">
                <?php if (isset($_SESSION['user'])): ?>
                    <li><button class="dropdown-item"><i class="fas fa-save"></i> Guardar Conversa</button></li>
                    <li><button class="dropdown-item text-danger" onclick="">
                            <i class="fas fa-trash"></i> Apagar Conversa
                    </button></li>
                <?php else: ?>
                    <li><button class="dropdown-item text-danger" onclick="clearConversation()">
                            <i class="fas fa-trash"></i> Apagar Conversa
                        </button></li>
                <?php endif; ?>
            </ul>
        </div>

        <div id="responses" class="responses"></div>

        <div id="thinking" class="thinking">
            <div class="spinner-border text-primary" role="status"></div>
            <span> Pensando...</span>
        </div>

        <div class="input-group">
            <input type="text" id="message" class="form-control" placeholder="Digite sua pergunta..." required>
            <button class="btn-send" onclick="sendMessage()"><i class="fas fa-paper-plane"></i> Enviar</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
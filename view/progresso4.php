<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Progresso Dinâmica</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .progress-container {
            margin-top: 50px;
            text-align: center;
        }
        .progress-step {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container progress-container">
    <h2>Progresso do Processo</h2>
    <div class="progress">
        <div id="progressBar"
             class="progress-bar progress-bar-striped progress-bar-animated"
             role="progressbar"
             style="width: 33%;"
             aria-valuemin="0"
             aria-valuemax="100">
            Aguardando Aprovação
        </div>
    </div>
    <div class="progress-step" id="progressStep">Etapa 1: Aguardando Aprovação</div>

    <div class="mt-4">
        <button class="btn btn-warning" onclick="atualizarProgresso(33, 'Aguardando Aprovação', 'warning')">
            Aguardando Aprovação
        </button>
        <button class="btn btn-info" onclick="atualizarProgresso(66, 'Aprovado', 'info')">
            Aprovado
        </button>
        <button class="btn btn-success" onclick="atualizarProgresso(100, 'Finalizado', 'success')">
            Finalizado
        </button>
    </div>
</div>

<script>
    function atualizarProgresso(porcentagem, texto, cor) {
        const progressBar = document.getElementById('progressBar');
        const progressStep = document.getElementById('progressStep');

        // Atualiza a largura da barra e o texto exibido
        progressBar.style.width = porcentagem + '%';
        progressBar.textContent = texto;

        // Remove todas as classes de cor e adiciona a nova cor
        progressBar.classList.remove('bg-warning', 'bg-info', 'bg-success');
        progressBar.classList.add('bg-' + cor);

        // Atualiza o texto abaixo da barra
        progressStep.textContent = `Etapa ${porcentagem / 33}: ${texto}`;
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

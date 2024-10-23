<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Progresso Animada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .progress-step {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Progresso do Processo</h2>
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
             role="progressbar"
             style="width: 33%;"
             aria-valuenow="33"
             aria-valuemin="0"
             aria-valuemax="100">
            Aguardando Aprovação
        </div>
    </div>
    <div class="progress-step">Etapa 1: Aguardando Aprovação</div>

    <div class="progress mt-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
             role="progressbar"
             style="width: 66%;"
             aria-valuenow="66"
             aria-valuemin="0"
             aria-valuemax="100">
            Aprovado
        </div>
    </div>
    <div class="progress-step">Etapa 2: Aprovado</div>

    <div class="progress mt-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
             role="progressbar"
             style="width: 100%;"
             aria-valuenow="100"
             aria-valuemin="0"
             aria-valuemax="100">
            Finalizado
        </div>
    </div>
    <div class="progress-step">Etapa 3: Finalizado</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

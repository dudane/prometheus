<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapas do Processo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .step {
            text-align: center;
            width: 25%;
            position: relative;
        }
        .step:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 100%;
            height: 4px;
            width: 100%;
            background-color: #e9ecef;
            z-index: -1;
        }
        .step:last-child:before {
            display: none;
        }
        .step.active {
            color: #0d6efd;
        }
        .step.active .badge {
            background-color: #0d6efd;
        }
        .step.completed {
            color: #28a745;
        }
        .step.completed .badge {
            background-color: #28a745;
        }
        .step.rejected {
            color: #dc3545;
        }
        .step.rejected .badge {
            background-color: #dc3545;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Etapas do Processo</h2>
    <div class="d-flex justify-content-between">
        <!-- Etapa 1: Aguardando Aprovação -->
        <div class="step active">
            <span class="badge rounded-pill">1</span>
            <p>Aguardando Aprovação</p>
        </div>

        <!-- Etapa 2: Rejeitado -->
        <div class="step rejected">
            <span class="badge rounded-pill">2</span>
            <p>Rejeitado</p>
        </div>

        <!-- Etapa 3: Aprovado -->
        <div class="step completed">
            <span class="badge rounded-pill">3</span>
            <p>Aprovado</p>
        </div>

        <!-- Etapa 4: Finalizado -->
        <div class="step completed">
            <span class="badge rounded-pill">4</span>
            <p>Finalizado</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    $rotaAtual = $_GET['url'] ?? 'dashboard';
    $rotaAtual = trim($rotaAtual, '/');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">

    <!-- CSS HEADER / FOOTER -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/footer.css">

    <!-- CSS POR PÁGINA (se existir) -->
    <?php if (!empty($css)) : ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= $css ?>">
    <?php endif; ?>
</head>

<body>

<div class="app-wrapper min-vh-100 d-flex flex-column">

    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg px-3">
            <div class="container-fluid justify-content-between">

                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-primary d-lg"
                            type="button"
                            id="btnToggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <a class="navbar-brand" href="<?= BASE_URL ?>/dashboard">
                        <span class="logo-white">HO</span>
                        <span class="logo-blue"> | SANTIAGO</span>
                    </a>
                </div>

                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none dropdown-toggle d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown">

                        <div class="user-avatar">
                            <?= strtoupper(substr($usuario, 0, 2)) ?>
                            <span class="status-badge online"></span>
                        </div>

                        <span class="d-none d-sm-inline fw-semibold">
                            <?= htmlspecialchars($usuario) ?>
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li class="dropdown-header text-center small text-muted">
                            Conta do usuário
                        </li>

                        <li>
                            <a class="dropdown-item" href="<?= BASE_URL ?>/perfil">
                                <i class="fas fa-user-cog me-2"></i> Configurações
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="<?= BASE_URL ?>/logout">
                                <i class="fas fa-sign-out-alt me-2"></i> Sair
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <!-- BODY -->
    <div class="app-body d-flex flex-grow-1">

    <!-- SIDEBAR -->
    <aside class="sidebar border-end d-flex flex-column" id="sidebar">
        <ul class="nav flex-column pt-3">

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/dashboard" class="nav-link <?= $rotaAtual === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-chart-line me-2"></i>
                    Dashboard
                </a>
            </li>

            <!-- USUÁRIOS -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/usuarios" class="nav-link">
                    <i class="fas fa-users me-2"></i>
                    Usuários
                </a>
            </li>

            <!-- EMPRESAS -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/empresas" class="nav-link">
                    <i class="fas fa-building me-2"></i>
                    Empresas
                </a>
            </li>

            <!-- PLANOS DE QUANTIFICAÇÃO -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/relatorios" class="nav-link">
                    <i class="fas fa-file-signature me-2"></i>
                    Planos de Quantificação
                </a>
            </li>

            <!-- INVENTÁRIO DE RISCOS -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/riscos" class="nav-link">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Inventário de Riscos
                </a>
            </li>

            <!-- DOCUMENTOS TÉCNICOS -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/laudos" class="nav-link">
                    <i class="fas fa-file-medical me-2"></i>
                    Documentos Técnicos
                </a>
            </li>

            <!-- EPI / EPC -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/epis" class="nav-link">
                    <i class="fas fa-hard-hat me-2"></i>
                    EPI / EPC
                </a>
            </li>

            <!-- PERMISSÕES DE TRABALHO -->
            <li class="nav-item">
                <a href="<?= BASE_URL ?>/pets" class="nav-link">
                    <i class="fas fa-tools me-2"></i>
                    Permissões de Trabalho
                </a>
            </li>

        </ul>

        <div class="mt-auto p-3 border-top">
            <a href="<?= BASE_URL ?>/logout" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> Sair do sistema
            </a>
        </div>
    </aside>

        <!-- CONTEÚDO -->
        <main class="content flex-grow-1 p-4">

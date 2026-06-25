<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $rotaAtual = $_GET['url'] ?? 'dashboard';
    $rotaAtual = trim($rotaAtual, '/');

    $usuario = $_SESSION['nome'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= BASE_URL ?>/image/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= BASE_URL ?>/image/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- CSS BASE / GLOBAL -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/footer.css">

    <!-- CSS COMPONENTES / RESPONSIVO -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/components.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/responsive.css">

    <!-- CSS POR PÁGINA -->
    <?php if (!empty($css)) : ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= $css ?>">
    <?php endif; ?>
</head>

<body>

<div class="app-wrapper">

    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg px-3">
            
            <div class="container-fluid d-flex justify-content-between align-items-center flex-nowrap">

                <!-- ESQUERDA (LOGO + MENU) -->
                <div class="d-flex align-items-center gap-4 flex-shrink-0">

                    <!-- Botão mobile/tablet -->
                    <button class="btn btn-outline-primary d-lg-none flex-shrink-0" id="btnToggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Logo -->
                    <a class="logo d-flex align-items-center" href="<?= BASE_URL ?>/dashboard">
                        <img 
                            src="<?= BASE_URL ?>/image/logo.png" 
                            alt="Logo NEXUS SST"
                            class="img-fluid logo-img"
                        >
                    </a>

                </div>

                <!-- DIREITA (USUÁRIO) -->
                <div class="dropdown ms-auto">

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
    <div class="app-body">

        <!-- SIDEBAR -->
        <aside class="sidebar border-end d-flex flex-column" id="sidebar">

            <ul class="nav flex-column pt-3" id="sidebarMenu">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/dashboard"
                    class="nav-link <?= $rotaAtual === 'dashboard' ? 'active' : '' ?>">
                        <i class="fas fa-chart-line me-2"></i>
                        Dashboard
                    </a>
                </li>

                <!-- ===================== -->
                <!-- CADASTROS -->
                <!-- ===================== -->
                <?php
                $rotasCadastros = [
                    'usuarios','tecnicos','riscos',
                    'empresas','unidades','setores','cargos'
                ];
                $menuCadastrosAberto = in_array($rotaAtual, $rotasCadastros);
                ?>

                <li class="nav-item">

                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuCadastrosAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuCadastros"
                    role="button">

                        <span>
                            <i class="fas fa-database me-2"></i>
                            Cadastros
                        </span>

                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuCadastrosAberto ? 'show' : '' ?>"
                        id="menuCadastros"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">

                            <!-- USUÁRIOS -->
                            <li>
                                <a href="<?= BASE_URL ?>/usuarios"
                                class="nav-link <?= $rotaAtual === 'usuarios' ? 'active' : '' ?>">
                                    <i class="fas fa-users me-2"></i>
                                    Usuários
                                </a>
                            </li>

                            <!-- TÉCNICOS -->
                            <li>
                                <a href="<?= BASE_URL ?>/veiculos"
                                class="nav-link <?= $rotaAtual === 'veiculos' ? 'active' : '' ?>">
                                    <i class="fas fa-car me-2"></i>
                                    Veículos
                                </a>
                            </li>

                            <!-- RISCOS -->
                            <li>
                                <a href="<?= BASE_URL ?>/riscos"
                                class="nav-link <?= $rotaAtual === 'riscos' ? 'active' : '' ?>">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Riscos
                                </a>
                            </li>

                            <!-- ===================== -->
                            <!-- ESTRUTURA ORGANIZACIONAL -->
                            <!-- ===================== -->
                            <?php
                            $rotasEstrutura = ['empresas','unidades','setores','cargos'];
                            $menuEstruturaAberto = in_array($rotaAtual, $rotasEstrutura);
                            ?>

                            <li>

                                <a class="nav-link d-flex justify-content-between align-items-center <?= $menuEstruturaAberto ? '' : 'collapsed' ?>"
                                data-bs-toggle="collapse"
                                href="#menuEstrutura"
                                role="button">

                                    <span>
                                        <i class="fas fa-sitemap me-2"></i>
                                        Estrutura Organizacional
                                    </span>

                                    <i class="fas fa-chevron-down small"></i>
                                </a>

                                <div class="collapse <?= $menuEstruturaAberto ? 'show' : '' ?>"
                                    id="menuEstrutura">

                                    <ul class="nav flex-column ms-3">

                                        <li>
                                            <a href="<?= BASE_URL ?>/empresas"
                                            class="nav-link <?= $rotaAtual === 'empresas' ? 'active' : '' ?>">
                                                <i class="fas fa-building me-2"></i>
                                                Empresas
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= BASE_URL ?>/unidades"
                                            class="nav-link <?= $rotaAtual === 'unidades' ? 'active' : '' ?>">
                                                <i class="fas fa-industry me-2"></i>
                                                Unidades
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= BASE_URL ?>/setores"
                                            class="nav-link <?= $rotaAtual === 'setores' ? 'active' : '' ?>">
                                                <i class="fas fa-layer-group me-2"></i>
                                                Setores
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= BASE_URL ?>/cargos"
                                            class="nav-link <?= $rotaAtual === 'cargos' ? 'active' : '' ?>">
                                                <i class="fas fa-briefcase me-2"></i>
                                                Cargos
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= BASE_URL ?>/hierarquias"
                                            class="nav-link <?= $rotaAtual === 'hierarquias' ? 'active' : '' ?>">
                                                
                                                <i class="fas fa-file-csv me-2"></i>
                                                Hierarquia
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </li>

                        </ul>

                    </div>
                </li>

                <!-- ===================== -->
                <!-- GESTÃO TÉCNICA -->
                <!-- ===================== -->
                <?php
                $rotasTecnicas = ['visitas','checklist','quantificacao','nao-conformidades'];
                $menuTecnicoAberto = in_array($rotaAtual, $rotasTecnicas);
                ?>

                <li class="nav-item">

                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuTecnicoAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuTecnico"
                    role="button">

                        <span>
                            <i class="fas fa-flask me-2"></i>
                            Gestão Técnica
                        </span>

                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuTecnicoAberto ? 'show' : '' ?>"
                        id="menuTecnico"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">

                            <li>
                                <a href="<?= BASE_URL ?>/visitas"
                                class="nav-link <?= $rotaAtual === 'visitas' ? 'active' : '' ?>">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    Visitas
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL ?>/checklist"
                                class="nav-link <?= $rotaAtual === 'checklist' ? 'active' : '' ?>">
                                    <i class="fas fa-clipboard-check me-2"></i>
                                    Levantamentos
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL ?>/quantificacao"
                                class="nav-link <?= $rotaAtual === 'quantificacao' ? 'active' : '' ?>">
                                    <i class="fas fa-vials me-2"></i>
                                    Quantificação
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL ?>/nao-conformidades"
                                class="nav-link <?= $rotaAtual === 'nao-conformidades' ? 'active' : '' ?>">
                                    <i class="fas fa-times-circle me-2"></i>
                                    Não Conformidades
                                </a>
                            </li>

                        </ul>

                    </div>
                </li>

                <!-- RELATÓRIOS -->
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/relatorios"
                    class="nav-link <?= $rotaAtual === 'relatorios' ? 'active' : '' ?>">
                        <i class="fas fa-file-pdf me-2"></i>
                        Relatórios
                    </a>
                </li>

                <!-- CONFIGURAÇÕES -->
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/configuracoes"
                    class="nav-link <?= $rotaAtual === 'configuracoes' ? 'active' : '' ?>">
                        <i class="fas fa-gear me-2"></i>
                        Configurações
                    </a>
                </li>

            </ul>

            <!-- LOGOUT -->
            <div class="logout-box p-3 border-top">
                <a href="<?= BASE_URL ?>/logout" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Sair do sistema
                </a>
            </div>

        </aside>

        <!-- CONTEÚDO -->
        <main class="content p-4">
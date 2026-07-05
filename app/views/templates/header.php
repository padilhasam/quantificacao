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
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/image/favicon.png?v=2">
    <link rel="shortcut icon" href="<?= BASE_URL ?>/image/favicon.ico?v=3" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Tom-Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

    <!-- CSS BASE / GLOBAL -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/nexus-theme.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/footer.css">

    <!-- CSS COMPONENTES / RESPONSIVO -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/components.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/responsive.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/sidebar.css">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/css/calendario-visitas.css" rel="stylesheet">

    <!-- CSS POR PÁGINA -->
    <?php if (!empty($css)) : ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= $css ?>">
    <?php endif; ?>
</head>

<body>

<div class="app-wrapper">

    <!-- HEADER -->
    <header class="nexus-topbar">
        <nav class="navbar navbar-expand-lg px-3">

            <div class="container-fluid d-flex align-items-center gap-3 flex-nowrap">

                <!-- ESQUERDA -->
                <div class="d-flex align-items-center gap-3 flex-shrink-0">

                    <button class="btn btn-outline-primary d-lg-none nexus-icon-btn" id="btnToggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <a class="logo d-flex align-items-center" href="<?= BASE_URL ?>/dashboard">
                        <img
                            src="<?= BASE_URL ?>/image/logo.png"
                            alt="Logo NEXUS SST"
                            class="img-fluid logo-img"
                        >
                    </a>

                </div>

                <!-- PESQUISA GLOBAL -->
                <div class="nexus-global-search d-none d-lg-flex flex-grow-1 mx-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control border-start-0"
                            placeholder="Pesquisar empresa, unidade, cargo, risco..."
                        >
                    </div>
                </div>

                <!-- DIREITA -->
                <div class="d-flex align-items-center gap-2 ms-auto">

                    <!-- AGENDA -->
                    <a href="<?= BASE_URL ?>/visitas"
                    class="btn btn-light nexus-topbar-btn position-relative"
                    title="Agenda">
                        <i class="fas fa-calendar-days"></i>
                    </a>

                    <!-- MENSAGENS -->
                    <a href="<?= BASE_URL ?>/mensagens"
                    class="btn btn-light nexus-topbar-btn position-relative"
                    title="Mensagens">
                        <i class="fas fa-comments"></i>
                        <span class="nexus-notification-badge bg-info">3</span>
                    </a>

                    <!-- NOTIFICAÇÕES -->
                    <div class="dropdown">
                        <button class="btn btn-light nexus-topbar-btn position-relative"
                                data-bs-toggle="dropdown"
                                title="Notificações">
                            <i class="fas fa-bell"></i>
                            <span class="nexus-notification-badge bg-danger">8</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow nexus-dropdown-lg">
                            <li class="dropdown-header fw-bold text-dark">
                                Notificações
                            </li>

                            <li>
                                <a class="dropdown-item small" href="#">
                                    <i class="fas fa-calendar-check text-primary me-2"></i>
                                    Nova visita agendada
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item small" href="#">
                                    <i class="fas fa-vials text-warning me-2"></i>
                                    Quantificação pendente
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item small" href="#">
                                    <i class="fas fa-triangle-exclamation text-danger me-2"></i>
                                    Não conformidade registrada
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-center small text-primary fw-semibold"
                                href="<?= BASE_URL ?>/notificacoes">
                                    Ver todas
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- USUÁRIO -->
                    <div class="dropdown">

                        <button class="btn btn-link text-decoration-none dropdown-toggle d-flex align-items-center gap-2 nexus-user-btn"
                                data-bs-toggle="dropdown">

                            <div class="user-avatar">
                                <?= strtoupper(substr($usuario, 0, 2)) ?>
                                <span class="status-badge online"></span>
                            </div>

                            <div class="d-none d-sm-block text-start lh-sm">
                                <span class="fw-semibold d-block text-dark">
                                    <?= htmlspecialchars($usuario) ?>
                                </span>
                                <small class="text-muted">Online</small>
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="dropdown-header text-center small text-muted">
                                Conta do usuário
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/perfil">
                                    <i class="fas fa-user-cog me-2"></i> Meu Perfil
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/visitas">
                                    <i class="fas fa-calendar-days me-2"></i> Minha Agenda
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>/mensagens">
                                    <i class="fas fa-comments me-2"></i> Mensagens
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

                <!-- CAMPO -->
                <?php
                $rotasCampo = ['visitas', 'levantamentos', 'checklists'];
                $menuCampoAberto = in_array($rotaAtual, $rotasCampo);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuCampoAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuCampo"
                    role="button">
                        <span>
                            <i class="fas fa-tablet-screen-button me-2"></i>
                            Campo
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuCampoAberto ? 'show' : '' ?>"
                        id="menuCampo"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li>
                                <a href="<?= BASE_URL ?>/visitas"
                                class="nav-link <?= $rotaAtual === 'visitas' ? 'active' : '' ?>">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    Agenda
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL ?>/levantamentos"
                                class="nav-link <?= $rotaAtual === 'levantamentos' ? 'active' : '' ?>">
                                    <i class="fas fa-clipboard-check me-2"></i>
                                    Visitas Técnicas
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL ?>/checklists"
                                class="nav-link <?= $rotaAtual === 'checklists' ? 'active' : '' ?>">
                                    <i class="fas fa-list-check me-2"></i>
                                    Check-lists
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- EMPRESAS / HIERARQUIA -->
                <?php
                $rotasEmpresas = ['empresas', 'unidades', 'setores', 'cargos', 'funcionarios', 'hierarquias'];
                $menuEmpresasAberto = in_array($rotaAtual, $rotasEmpresas);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuEmpresasAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuEmpresas"
                    role="button">
                        <span>
                            <i class="fas fa-building me-2"></i>
                            Empresas
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuEmpresasAberto ? 'show' : '' ?>"
                        id="menuEmpresas"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/empresas" class="nav-link <?= $rotaAtual === 'empresas' ? 'active' : '' ?>"><i class="fas fa-building me-2"></i>Empresas</a></li>
                            <li><a href="<?= BASE_URL ?>/unidades" class="nav-link <?= $rotaAtual === 'unidades' ? 'active' : '' ?>"><i class="fas fa-industry me-2"></i>Unidades</a></li>
                            <li><a href="<?= BASE_URL ?>/setores" class="nav-link <?= $rotaAtual === 'setores' ? 'active' : '' ?>"><i class="fas fa-layer-group me-2"></i>Setores</a></li>
                            <li><a href="<?= BASE_URL ?>/cargos" class="nav-link <?= $rotaAtual === 'cargos' ? 'active' : '' ?>"><i class="fas fa-briefcase me-2"></i>Cargos</a></li>
                            <li><a href="<?= BASE_URL ?>/funcionarios" class="nav-link <?= $rotaAtual === 'funcionarios' ? 'active' : '' ?>"><i class="fas fa-id-badge me-2"></i>Funcionários</a></li>
                            <li><a href="<?= BASE_URL ?>/hierarquias" class="nav-link <?= $rotaAtual === 'hierarquias' ? 'active' : '' ?>"><i class="fas fa-sitemap me-2"></i>Hierarquia / Importação SOC</a></li>
                        </ul>
                    </div>
                </li>

                <!-- BIBLIOTECA TÉCNICA -->
                <?php
                $rotasBiblioteca = ['riscos', 'treinamentos', 'itens-fiscalizacao', 'fontes-geradoras', 'medidas-controle'];
                $menuBibliotecaAberto = in_array($rotaAtual, $rotasBiblioteca);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuBibliotecaAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuBiblioteca"
                    role="button">
                        <span>
                            <i class="fas fa-book-open me-2"></i>
                            Biblioteca Técnica
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuBibliotecaAberto ? 'show' : '' ?>"
                        id="menuBiblioteca"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/riscos" class="nav-link <?= $rotaAtual === 'riscos' ? 'active' : '' ?>"><i class="fas fa-triangle-exclamation me-2"></i>Riscos</a></li>
                            <li><a href="<?= BASE_URL ?>/treinamentos" class="nav-link <?= $rotaAtual === 'treinamentos' ? 'active' : '' ?>"><i class="fas fa-chalkboard-user me-2"></i>Treinamentos</a></li>
                            <li><a href="<?= BASE_URL ?>/itens-fiscalizacao" class="nav-link <?= $rotaAtual === 'itens-fiscalizacao' ? 'active' : '' ?>"><i class="fas fa-clipboard-list me-2"></i>Itens de Fiscalização</a></li>
                            <li><a href="<?= BASE_URL ?>/fontes-geradoras" class="nav-link <?= $rotaAtual === 'fontes-geradoras' ? 'active' : '' ?>"><i class="fas fa-industry me-2"></i>Fontes Geradoras</a></li>
                            <li><a href="<?= BASE_URL ?>/medidas-controle" class="nav-link <?= $rotaAtual === 'medidas-controle' ? 'active' : '' ?>"><i class="fas fa-shield-heart me-2"></i>Medidas de Controle</a></li>
                        </ul>
                    </div>
                </li>

                <!-- RESULTADOS DA VISITA -->
                <?php
                $rotasResultados = ['quantificacoes', 'nao_conformidades', 'relatorios'];
                $menuResultadosAberto = in_array($rotaAtual, $rotasResultados);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuResultadosAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuResultados"
                    role="button">
                        <span>
                            <i class="fas fa-chart-simple me-2"></i>
                            Resultados da Visita
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuResultadosAberto ? 'show' : '' ?>"
                        id="menuResultados"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/quantificacoes" class="nav-link <?= $rotaAtual === 'quantificacoes' ? 'active' : '' ?>"><i class="fas fa-vials me-2"></i>Quantificações</a></li>
                            <li><a href="<?= BASE_URL ?>/nao_conformidades" class="nav-link <?= $rotaAtual === 'nao_conformidades' ? 'active' : '' ?>"><i class="fas fa-circle-exclamation me-2"></i>Não Conformidades</a></li>
                            <li><a href="<?= BASE_URL ?>/relatorios" class="nav-link <?= $rotaAtual === 'relatorios' ? 'active' : '' ?>"><i class="fas fa-file-pdf me-2"></i>Relatórios Técnicos</a></li>
                        </ul>
                    </div>
                </li>

                <!-- COMUNICAÇÃO -->
                <?php
                $rotasComunicacao = ['mensagens', 'notificacoes'];
                $menuComunicacaoAberto = in_array($rotaAtual, $rotasComunicacao);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuComunicacaoAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuComunicacao"
                    role="button">
                        <span>
                            <i class="fas fa-comments me-2"></i>
                            Comunicação
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuComunicacaoAberto ? 'show' : '' ?>"
                        id="menuComunicacao"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/mensagens" class="nav-link <?= $rotaAtual === 'mensagens' ? 'active' : '' ?>"><i class="fas fa-envelope me-2"></i>Mensagens</a></li>
                            <li><a href="<?= BASE_URL ?>/notificacoes" class="nav-link <?= $rotaAtual === 'notificacoes' ? 'active' : '' ?>"><i class="fas fa-bell me-2"></i>Notificações</a></li>
                        </ul>
                    </div>
                </li>

                <!-- RECURSOS -->
                <?php
                $rotasRecursos = ['veiculos', 'equipamentos'];
                $menuRecursosAberto = in_array($rotaAtual, $rotasRecursos);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuRecursosAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuRecursos"
                    role="button">
                        <span>
                            <i class="fas fa-toolbox me-2"></i>
                            Recursos
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuRecursosAberto ? 'show' : '' ?>"
                        id="menuRecursos"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/veiculos" class="nav-link <?= $rotaAtual === 'veiculos' ? 'active' : '' ?>"><i class="fas fa-car me-2"></i>Veículos</a></li>
                            <li><a href="<?= BASE_URL ?>/equipamentos" class="nav-link <?= $rotaAtual === 'equipamentos' ? 'active' : '' ?>"><i class="fas fa-screwdriver-wrench me-2"></i>Equipamentos</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CONFIGURAÇÕES -->
                <?php
                $rotasConfiguracoes = ['usuarios', 'configuracoes'];
                $menuConfiguracoesAberto = in_array($rotaAtual, $rotasConfiguracoes);
                ?>

                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center <?= $menuConfiguracoesAberto ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse"
                    href="#menuConfiguracoes"
                    role="button">
                        <span>
                            <i class="fas fa-gear me-2"></i>
                            Configurações
                        </span>
                        <i class="fas fa-chevron-down small"></i>
                    </a>

                    <div class="collapse <?= $menuConfiguracoesAberto ? 'show' : '' ?>"
                        id="menuConfiguracoes"
                        data-bs-parent="#sidebarMenu">

                        <ul class="nav flex-column ms-3">
                            <li><a href="<?= BASE_URL ?>/usuarios" class="nav-link <?= $rotaAtual === 'usuarios' ? 'active' : '' ?>"><i class="fas fa-users-gear me-2"></i>Usuários</a></li>
                            <li><a href="<?= BASE_URL ?>/configuracoes" class="nav-link <?= $rotaAtual === 'configuracoes' ? 'active' : '' ?>"><i class="fas fa-sliders me-2"></i>Parâmetros do Sistema</a></li>
                        </ul>
                    </div>
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title><?= APP_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Estilos customizados (se houver) -->
    <link rel="stylesheet" href="../public/css/style.css" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= BASE_URL ?>/dashboard"><?= APP_NAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <span class="nav-link text-white">Olá, <?= htmlspecialchars($_SESSION['nome'] ?? 'Usuário') ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>/login/logout">
            <i class="fas fa-sign-out-alt"></i> Sair
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
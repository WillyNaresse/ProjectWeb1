<?php
require_once __DIR__ . '/../app/core/Session.php';
Session::requirePageAuth();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - AutoPortal</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/api.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/perfil.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="perfil.php" class="logo">AutoPortal <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: normal;">| Painel</span></a>
            <div class="nav-links">
                <!-- Preenchido via utils.js -->
            </div>
        </nav>
    </header>

    <main>
        <div class="page-title" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 id="welcome-msg">Carregando...</h2>
            <a href="novo-anuncio.php" class="btn btn-primary">+ Novo Anúncio</a>
        </div>

        <section class="grid-container">
            <div class="container-box" style="flex: 1; min-width: 250px; text-align: center;">
                <h3 style="color: var(--text-muted); font-size: 1.1rem;">Meus Anúncios Ativos</h3>
                <div id="count-anuncios" style="font-size: 3rem; font-weight: bold; color: var(--primary-color);">...</div>
                <a href="meus-anuncios.php" style="display: block; margin-top: 1rem;">Gerenciar Anúncios</a>
            </div>

            <div class="container-box" style="flex: 1; min-width: 250px; text-align: center;">
                <h3 style="color: var(--text-muted); font-size: 1.1rem;">Visualizações (Últimos 30 dias)</h3>
                <div style="font-size: 3rem; font-weight: bold; color: var(--text-main);">458</div>
                <span style="display: block; margin-top: 1rem; color: var(--text-muted);">Estatística simulada</span>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 AutoPortal. Projeto Acadêmico UFU.</p>
    </footer>
</body>
</html>

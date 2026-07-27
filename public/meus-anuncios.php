<?php
require_once __DIR__ . '/../app/core/Session.php';
Session::requirePageAuth();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Anúncios - AutoPortal</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/api.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/meus-anuncios.js"></script>
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
            <h2>Meus Anúncios</h2>
            <a href="novo-anuncio.php" class="btn btn-primary">+ Novo Anúncio</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Marca / Modelo</th>
                        <th>Ano</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="meus-anuncios-tbody">
                    <tr><td colspan="5">Carregando...</td></tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 AutoPortal. Projeto Acadêmico UFU.</p>
    </footer>
</body>
</html>

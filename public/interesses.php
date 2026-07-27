<?php
require_once __DIR__ . '/../app/core/Session.php';
Session::requirePageAuth();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens de Interesse - AutoPortal</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/api.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/interesses.js"></script>
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
        <div class="page-title">
            <h2 id="interesses-title">Mensagens Recebidas</h2>
            <p style="color: var(--text-muted);">Contatos de pessoas interessadas nos seus veículos.</p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Veículo</th>
                        <th>Interessado(a)</th>
                        <th>Contato</th>
                        <th>Mensagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="interesses-tbody">
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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Veículo - AutoPortal</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/api.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/anuncio.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">AutoPortal</a>
            <div class="nav-links">
                <a href="index.php">Início</a>
                <a href="login.php">Login</a>
                <a href="cadastro.php" class="btn btn-primary" style="color: white;">Criar Conta</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="page-title" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 id="anuncio-title">Carregando...</h2>
            <a href="index.php" class="btn btn-secondary">Voltar aos anúncios</a>
        </div>

        <section class="details-container">
            <div class="details-gallery">
                <img id="main-img" src="assets/images/default.png" alt="Foto Principal" class="details-main-img">
                <div class="details-thumbnails" id="thumbnails-container">
                    <!-- Gerado pelo JS -->
                </div>
            </div>

            <div class="details-info">
                <div class="details-price" id="anuncio-preco">R$ 0,00</div>
                
                <ul class="features-list">
                    <li><strong>Marca:</strong> <span id="anuncio-marca"></span></li>
                    <li><strong>Modelo:</strong> <span id="anuncio-modelo"></span></li>
                    <li><strong>Ano:</strong> <span id="anuncio-ano"></span></li>
                    <li><strong>Cor:</strong> <span id="anuncio-cor"></span></li>
                    <li><strong>Quilometragem:</strong> <span id="anuncio-km"></span> km</li>
                    <li><strong>Estado:</strong> <span id="anuncio-estado"></span></li>
                    <li><strong>Cidade:</strong> <span id="anuncio-cidade"></span></li>
                </ul>
                
                <h3>Descrição</h3>
                <p id="anuncio-desc" style="margin-bottom: 2rem; color: var(--text-muted);">
                    Carregando descrição...
                </p>

                <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #ddd;">
                
                <h3>Tenho Interesse</h3>
                <form id="form-interesse" style="margin-top: 1rem;">
                    <div class="form-group">
                        <label for="int-nome">Seu Nome</label>
                        <input type="text" id="int-nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="int-telefone">Seu Telefone</label>
                        <input type="tel" id="int-telefone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="int-mensagem">Mensagem</label>
                        <textarea id="int-mensagem" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Enviar Mensagem</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 AutoPortal. Projeto Acadêmico UFU.</p>
    </footer>
</body>
</html>

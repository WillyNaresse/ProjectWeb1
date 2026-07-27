<?php
require_once __DIR__ . '/../app/core/Session.php';
Session::requirePageAuth();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Anúncio - AutoPortal</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/api.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/novo-anuncio.js"></script>
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
            <h2>Cadastrar Novo Veículo</h2>
            <a href="meus-anuncios.php" class="btn btn-secondary">Cancelar</a>
        </div>

        <div class="container-box" style="max-width: 800px;">
            <form id="form-novo-anuncio">
                
                <h3 style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">Informações Básicas</h3>
                
                <div class="grid-container" style="gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="marca">Marca</label>
                        <!-- No mock HTML era um select fixo. Podemos deixar texto livre ou carregar as marcas. Para cadastro é comum texto para marcas novas -->
                        <input type="text" id="marca" name="marca" class="form-control" placeholder="Ex: Chevrolet" required>
                    </div>
                    
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="modelo">Modelo</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ex: Onix LT" required>
                    </div>
                </div>

                <div class="grid-container" style="gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="flex: 1; min-width: 150px;">
                        <label for="ano">Ano</label>
                        <input type="text" id="ano" name="ano" class="form-control" placeholder="Ex: 2020/2021" required>
                    </div>
                    
                    <div class="form-group" style="flex: 1; min-width: 150px;">
                        <label for="cor">Cor</label>
                        <input type="text" id="cor" name="cor" class="form-control" placeholder="Ex: Branco" required>
                    </div>

                    <div class="form-group" style="flex: 1; min-width: 150px;">
                        <label for="km">Quilometragem</label>
                        <input type="number" id="km" name="quilometragem" class="form-control" placeholder="Ex: 45000" required>
                    </div>
                </div>

                <div class="grid-container" style="gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="estado">Estado (UF)</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="SP">São Paulo (SP)</option>
                            <option value="MG">Minas Gerais (MG)</option>
                            <option value="RJ">Rio de Janeiro (RJ)</option>
                            <option value="RS">Rio Grande do Sul (RS)</option>
                            <option value="PR">Paraná (PR)</option>
                        </select>
                    </div>
                    
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Ex: São Paulo, SP" required>
                    </div>

                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label for="valor">Valor (R$)</label>
                        <input type="number" id="valor" name="valor" class="form-control" placeholder="Ex: 55000" step="0.01" required>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 2rem;">
                    <label for="descricao">Descrição Completa</label>
                    <textarea id="descricao" name="descricao" class="form-control" rows="5" placeholder="Descreva os detalhes, opcionais e estado de conservação do veículo..." required></textarea>
                </div>

                <h3 style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">Fotos</h3>

                    <div class="form-group">
                        <label for="fotos">Fotos (Mínimo 3)</label>
                        <input type="file" id="fotos" name="fotos[]" class="form-control" multiple accept="image/*" required>
                        <small style="color: var(--text-muted);">De acordo com as regras, envie no mínimo 3 fotos do veículo.</small>
                    </div>

                <div class="form-group" style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                    <button type="reset" class="btn btn-secondary">Limpar Campos</button>
                    <button type="submit" class="btn btn-primary">Salvar Anúncio</button>
                </div>

            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 AutoPortal. Projeto Acadêmico UFU.</p>
    </footer>
</body>
</html>

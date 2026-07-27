<?php
// Exibir todos os erros em ambiente de desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();

// Caminho absoluto para a pasta app
define('APP_PATH', __DIR__ . '/../../app');

// Autoload simples (não otimizado, apenas para fins de estudo)
spl_autoload_register(function ($className) {
    $paths = [
        APP_PATH . '/core/',
        APP_PATH . '/controllers/',
        APP_PATH . '/models/'
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Inicializar Sessão
Session::start();

// Configurar Roteador
$router = new Router();

// =====================================
// DEFINIÇÃO DAS ROTAS DA API
// =====================================

// Rotas de Autenticação (Públicas)
$router->post('/api/login', ['AuthController', 'login']);
$router->post('/api/logout', ['AuthController', 'logout']);
$router->post('/api/cadastrar', ['AuthController', 'cadastrar']);
$router->get('/api/me', ['AuthController', 'me']); // Retorna infos do usuário logado

// Rotas de Anúncios (Públicas)
$router->get('/api/anuncios', ['AnuncioController', 'listar']); // Aceita filtros via query string
$router->get('/api/anuncios/{id}', ['AnuncioController', 'detalhes']);
$router->get('/api/marcas', ['AnuncioController', 'marcas']);
$router->get('/api/modelos', ['AnuncioController', 'modelos']); // Aceita ?marca=
$router->get('/api/cidades', ['AnuncioController', 'cidades']); // Aceita ?modelo=

// Rotas de Anúncios (Restritas)
$router->get('/api/meus-anuncios', ['AnuncioController', 'listarMeus']); // Restrita
$router->post('/api/anuncios', ['AnuncioController', 'criar']); // Upload multipart
$router->delete('/api/anuncios/{id}', ['AnuncioController', 'excluir']);

// Rotas de Interesse
$router->post('/api/interesses', ['InteresseController', 'registrar']); // Pública
$router->get('/api/meus-interesses', ['InteresseController', 'listarTodos']); // Restrita
$router->get('/api/anuncios/{id}/interesses', ['InteresseController', 'listarPorAnuncio']); // Restrita
$router->delete('/api/interesses/{id}', ['InteresseController', 'excluir']); // Restrita

// Despachar a requisição
$router->dispatch();
?>

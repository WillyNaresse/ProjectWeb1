<?php
class Router {
    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function delete($uri, $action) {
        $this->routes['DELETE'][$uri] = $action;
    }

    public function put($uri, $action) {
        $this->routes['PUT'][$uri] = $action;
    }

    public function dispatch() {
        $method = Request::getMethod();
        $uri = Request::getUri();

        // O prefixo das chamadas AJAX deve ser sempre /api
        // Vamos extrair a rota exata
        
        // Verifica se a rota existe para este método
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $action) {
                // Suporte rudimentar para rotas dinâmicas como /api/anuncios/{id}
                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
                if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                    array_shift($matches); // Remove o match completo
                    $controllerName = $action[0];
                    $methodName = $action[1];

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        if (method_exists($controller, $methodName)) {
                            // Chama o método passando os parâmetros encontrados na URL
                            return call_user_func_array([$controller, $methodName], $matches);
                        }
                    }
                }
            }
        }

        Response::json(['success' => false, 'message' => 'Route not found: ' . $uri], 404);
    }
}
?>

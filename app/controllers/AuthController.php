<?php
class AuthController {
    public function login() {
        $data = Request::getJsonData();
        if (empty($data['email']) || empty($data['senha'])) {
            Response::json(['success' => false, 'message' => 'Campos obrigatórios vazios.'], 400);
        }

        $usuario = Usuario::findByEmail($data['email']);
        if ($usuario && password_verify($data['senha'], $usuario['SenhaHash'])) {
            Session::set('user_id', $usuario['Id']);
            Session::set('user_nome', $usuario['Nome']);
            Response::json(['success' => true, 'message' => 'Login realizado com sucesso.']);
        } else {
            Response::json(['success' => false, 'message' => 'E-mail ou senha incorretos.'], 401);
        }
    }

    public function cadastrar() {
        $data = Request::getJsonData();
        if (empty($data['nome']) || empty($data['cpf']) || empty($data['email']) || empty($data['senha']) || empty($data['telefone'])) {
            Response::json(['success' => false, 'message' => 'Preencha todos os campos.'], 400);
        }

        if (Usuario::findByEmail($data['email'])) {
            Response::json(['success' => false, 'message' => 'E-mail já cadastrado.'], 400);
        }

        $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT);
        
        try {
            Usuario::create($data['nome'], $data['cpf'], $data['email'], $senhaHash, $data['telefone']);
            Response::json(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
        } catch (Exception $e) {
            Response::json(['success' => false, 'message' => 'Erro ao cadastrar. O CPF pode já estar em uso.'], 500);
        }
    }

    public function logout() {
        Session::destroy();
        Response::json(['success' => true]);
    }

    public function me() {
        if (Session::isAuthenticated()) {
            Response::json(['success' => true, 'user' => ['nome' => Session::get('user_nome'), 'id' => Session::get('user_id')]]);
        } else {
            Response::json(['success' => false], 401);
        }
    }
}
?>

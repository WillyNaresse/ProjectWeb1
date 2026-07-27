<?php
class InteresseController {
    public function registrar() {
        $data = Request::getJsonData();
        if (empty($data['nome']) || empty($data['telefone']) || empty($data['mensagem']) || empty($data['id_anuncio'])) {
            Response::json(['success' => false, 'message' => 'Preencha todos os campos.'], 400);
        }

        if (Interesse::create($data)) {
            Response::json(['success' => true, 'message' => 'Interesse registrado com sucesso!']);
        } else {
            Response::json(['success' => false, 'message' => 'Erro ao registrar interesse.'], 500);
        }
    }

    public function listarPorAnuncio($idAnuncio) {
        Session::requireAuth();
        $interesses = Interesse::getByAnuncio($idAnuncio);
        Response::json(['success' => true, 'data' => $interesses]);
    }

    public function listarTodos() {
        Session::requireAuth();
        $idUsuario = Session::get('user_id');
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT i.*, a.Marca, a.Modelo 
            FROM Interesse i 
            INNER JOIN Anuncio a ON i.IdAnuncio = a.Id 
            WHERE a.IdAnunciante = :id_usuario 
            ORDER BY i.DataHora DESC
        ");
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();
        $interesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::json(['success' => true, 'data' => $interesses]);
    }

    public function excluir($id) {
        Session::requireAuth();
        $idUsuario = Session::get('user_id');

        if (Interesse::delete($id, $idUsuario)) {
            Response::json(['success' => true, 'message' => 'Interesse deletado.']);
        } else {
            Response::json(['success' => false, 'message' => 'Erro ao deletar interesse.'], 400);
        }
    }
}
?>

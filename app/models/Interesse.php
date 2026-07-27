<?php
class Interesse {
    public static function create($dados) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Interesse (Nome, Telefone, Mensagem, IdAnuncio) VALUES (:nome, :telefone, :mensagem, :id_anuncio)");
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':telefone', $dados['telefone']);
        $stmt->bindValue(':mensagem', $dados['mensagem']);
        $stmt->bindValue(':id_anuncio', $dados['id_anuncio']);
        return $stmt->execute();
    }

    public static function getByAnuncio($idAnuncio) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Interesse WHERE IdAnuncio = :id_anuncio ORDER BY DataHora DESC");
        $stmt->bindValue(':id_anuncio', $idAnuncio);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($idInteresse, $idUsuario) {
        $db = Database::getConnection();
        // Verifica se o interesse pertence a um anúncio do usuário logado
        $stmt = $db->prepare("
            DELETE i FROM Interesse i
            INNER JOIN Anuncio a ON i.IdAnuncio = a.Id
            WHERE i.Id = :id AND a.IdAnunciante = :id_usuario
        ");
        $stmt->bindValue(':id', $idInteresse);
        $stmt->bindValue(':id_usuario', $idUsuario);
        return $stmt->execute();
    }
}
?>

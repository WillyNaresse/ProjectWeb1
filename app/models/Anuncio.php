<?php
class Anuncio {
    public static function getAll($filtros = []) {
        $db = Database::getConnection();
        $query = "SELECT a.*, (SELECT NomeArqFoto FROM Foto f WHERE f.IdAnuncio = a.Id LIMIT 1) as FotoPrincipal FROM Anuncio a WHERE 1=1";
        
        $params = [];
        if (!empty($filtros['marca'])) {
            $query .= " AND Marca = :marca";
            $params[':marca'] = $filtros['marca'];
        }
        if (!empty($filtros['modelo'])) {
            $query .= " AND Modelo = :modelo";
            $params[':modelo'] = $filtros['modelo'];
        }
        if (!empty($filtros['cidade'])) {
            $query .= " AND Cidade = :cidade";
            $params[':cidade'] = $filtros['cidade'];
        }

        $query .= " ORDER BY DataHora DESC LIMIT 20";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Anuncio WHERE Id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($anuncio) {
            $stmtFotos = $db->prepare("SELECT * FROM Foto WHERE IdAnuncio = :id");
            $stmtFotos->bindValue(':id', $id);
            $stmtFotos->execute();
            $anuncio['fotos'] = $stmtFotos->fetchAll(PDO::FETCH_ASSOC);
        }
        return $anuncio;
    }

    public static function getByUsuario($idUsuario) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT a.*, (SELECT NomeArqFoto FROM Foto f WHERE f.IdAnuncio = a.Id LIMIT 1) as FotoPrincipal FROM Anuncio a WHERE IdAnunciante = :id_usuario ORDER BY DataHora DESC");
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMarcas() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT DISTINCT Marca FROM Anuncio ORDER BY Marca ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getModelos($marca = null) {
        $db = Database::getConnection();
        if ($marca) {
            $stmt = $db->prepare("SELECT DISTINCT Modelo FROM Anuncio WHERE Marca = :marca ORDER BY Modelo ASC");
            $stmt->bindValue(':marca', $marca);
            $stmt->execute();
        } else {
            $stmt = $db->query("SELECT DISTINCT Modelo FROM Anuncio ORDER BY Modelo ASC");
        }
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getCidades($modelo = null) {
        $db = Database::getConnection();
        if ($modelo) {
            $stmt = $db->prepare("SELECT DISTINCT Cidade FROM Anuncio WHERE Modelo = :modelo ORDER BY Cidade ASC");
            $stmt->bindValue(':modelo', $modelo);
            $stmt->execute();
        } else {
            $stmt = $db->query("SELECT DISTINCT Cidade FROM Anuncio ORDER BY Cidade ASC");
        }
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function create($dados, $idUsuario) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Anuncio (Marca, Modelo, Ano, Cor, Quilometragem, Descricao, Valor, Estado, Cidade, IdAnunciante) VALUES (:marca, :modelo, :ano, :cor, :km, :desc, :valor, :estado, :cidade, :id_usuario)");
        
        $stmt->bindValue(':marca', $dados['marca']);
        $stmt->bindValue(':modelo', $dados['modelo']);
        $stmt->bindValue(':ano', $dados['ano']);
        $stmt->bindValue(':cor', $dados['cor']);
        $stmt->bindValue(':km', $dados['quilometragem']);
        $stmt->bindValue(':desc', $dados['descricao']);
        $stmt->bindValue(':valor', $dados['valor']);
        $stmt->bindValue(':estado', $dados['estado']);
        $stmt->bindValue(':cidade', $dados['cidade']);
        $stmt->bindValue(':id_usuario', $idUsuario);
        
        if ($stmt->execute()) {
            return $db->lastInsertId();
        }
        return false;
    }

    public static function delete($id, $idUsuario) {
        $db = Database::getConnection();
        // Garante que só deleta se for do dono
        $stmt = $db->prepare("DELETE FROM Anuncio WHERE Id = :id AND IdAnunciante = :id_usuario");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':id_usuario', $idUsuario);
        return $stmt->execute();
    }
}
?>

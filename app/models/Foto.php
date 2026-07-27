<?php
class Foto {
    public static function create($idAnuncio, $nomeArquivo) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Foto (IdAnuncio, NomeArqFoto) VALUES (:id_anuncio, :nome)");
        $stmt->bindValue(':id_anuncio', $idAnuncio);
        $stmt->bindValue(':nome', $nomeArquivo);
        return $stmt->execute();
    }
}
?>

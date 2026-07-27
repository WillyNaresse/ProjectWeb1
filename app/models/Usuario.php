<?php
class Usuario {
    public static function findByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Anunciante WHERE Email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($nome, $cpf, $email, $senhaHash, $telefone) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Anunciante (Nome, CPF, Email, SenhaHash, Telefone) VALUES (:nome, :cpf, :email, :senha, :telefone)");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        $stmt->bindValue(':telefone', $telefone);
        return $stmt->execute();
    }
}
?>

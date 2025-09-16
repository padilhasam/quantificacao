<?php

require_once __DIR__ . '/../../core/Database.php';

class Empresa {
    private $db;

    public function __construct() {
        // Corrigido para usar corretamente o Database
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function listar() {
        $stmt = $this->db->prepare("SELECT * FROM empresas ORDER BY nome ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM empresas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO empresas (nome, cnpj, cnae, responsavel, contato_responsavel, endereco) 
                VALUES (:nome, :cnpj, :cnae, :responsavel, :contato_responsavel, :endereco)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':cnpj', $dados['cnpj']);
        $stmt->bindValue(':cnae', $dados['cnae']);
        $stmt->bindValue(':responsavel', $dados['responsavel']);
        $stmt->bindValue(':contato_responsavel', $dados['contato_responsavel']);
        $stmt->bindValue(':endereco', $dados['endereco']);
        return $stmt->execute();
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE empresas SET nome = :nome, cnpj = :cnpj, cnae = :cnae, 
                responsavel = :responsavel, contato_responsavel = :contato_responsavel, endereco = :endereco
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':cnpj', $dados['cnpj']);
        $stmt->bindValue(':cnae', $dados['cnae']);
        $stmt->bindValue(':responsavel', $dados['responsavel']);
        $stmt->bindValue(':contato_responsavel', $dados['contato_responsavel']);
        $stmt->bindValue(':endereco', $dados['endereco']);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM empresas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

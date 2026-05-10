<?php

require_once __DIR__ . '/../../core/Database.php';

class Empresa {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function listar() {
        $stmt = $this->db->prepare("
            SELECT * FROM empresas 
            ORDER BY COALESCE(nome_fantasia, razao_social) ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM empresas 
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO empresas (
                    razao_social, nome_fantasia, cnpj, inscricao_estadual,
                    telefone, email, responsavel, contato_responsavel,
                    endereco, cidade, estado, cep, ativo
                ) VALUES (
                    :razao_social, :nome_fantasia, :cnpj, :inscricao_estadual,
                    :telefone, :email, :responsavel, :contato_responsavel,
                    :endereco, :cidade, :estado, :cep, :ativo
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':razao_social', $dados['razao_social']);
        $stmt->bindValue(':nome_fantasia', $dados['nome_fantasia'] ?? null);
        $stmt->bindValue(':cnpj', $dados['cnpj'] ?? null);
        $stmt->bindValue(':inscricao_estadual', $dados['inscricao_estadual'] ?? null);
        $stmt->bindValue(':telefone', $dados['telefone'] ?? null);
        $stmt->bindValue(':email', $dados['email'] ?? null);
        $stmt->bindValue(':responsavel', $dados['responsavel'] ?? null);
        $stmt->bindValue(':contato_responsavel', $dados['contato_responsavel'] ?? null);
        $stmt->bindValue(':endereco', $dados['endereco'] ?? null);
        $stmt->bindValue(':cidade', $dados['cidade'] ?? null);
        $stmt->bindValue(':estado', $dados['estado'] ?? null);
        $stmt->bindValue(':cep', $dados['cep'] ?? null);
        $stmt->bindValue(':ativo', $dados['ativo'] ?? 1, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE empresas SET 
                    razao_social = :razao_social,
                    nome_fantasia = :nome_fantasia,
                    cnpj = :cnpj,
                    inscricao_estadual = :inscricao_estadual,
                    telefone = :telefone,
                    email = :email,
                    responsavel = :responsavel,
                    contato_responsavel = :contato_responsavel,
                    endereco = :endereco,
                    cidade = :cidade,
                    estado = :estado,
                    cep = :cep,
                    ativo = :ativo
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':razao_social', $dados['razao_social']);
        $stmt->bindValue(':nome_fantasia', $dados['nome_fantasia'] ?? null);
        $stmt->bindValue(':cnpj', $dados['cnpj'] ?? null);
        $stmt->bindValue(':inscricao_estadual', $dados['inscricao_estadual'] ?? null);
        $stmt->bindValue(':telefone', $dados['telefone'] ?? null);
        $stmt->bindValue(':email', $dados['email'] ?? null);
        $stmt->bindValue(':responsavel', $dados['responsavel'] ?? null);
        $stmt->bindValue(':contato_responsavel', $dados['contato_responsavel'] ?? null);
        $stmt->bindValue(':endereco', $dados['endereco'] ?? null);
        $stmt->bindValue(':cidade', $dados['cidade'] ?? null);
        $stmt->bindValue(':estado', $dados['estado'] ?? null);
        $stmt->bindValue(':cep', $dados['cep'] ?? null);
        $stmt->bindValue(':ativo', $dados['ativo'] ?? 1, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("
            DELETE FROM empresas 
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
<?php

class Unidade extends Model {

    public function listarTudo() {
        // Traz as unidades com o nome fantasia ou razão social da empresa vinculada
        $sql = "SELECT u.*, e.razao_social, e.nome_fantasia 
                FROM unidades u 
                INNER JOIN empresas e ON u.empresa_id = e.id 
                ORDER BY u.nome ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM unidades WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmpresa($empresa_id) {
        $sql = "SELECT * FROM unidades WHERE empresa_id = :empresa_id AND ativo = 1 ORDER BY nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':empresa_id' => $empresa_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO unidades (empresa_id, nome, cnpj, endereco, cidade, estado, telefone, ativo) 
                VALUES (:empresa_id, :nome, :cnpj, :endereco, :cidade, :estado, :telefone, :ativo)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':empresa_id' => $dados['empresa_id'],
            ':nome'       => $dados['nome'],
            ':cnpj'       => $dados['cnpj'] ?? null,
            ':endereco'   => $dados['endereco'] ?? null,
            ':cidade'     => $dados['cidade'] ?? null,
            ':estado'     => $dados['estado'] ?? null,
            ':telefone'   => $dados['telefone'] ?? null,
            ':ativo'      => $dados['ativo'] ?? 1
        ]);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE unidades SET 
                    empresa_id = :empresa_id, 
                    nome = :nome, 
                    cnpj = :cnpj, 
                    endereco = :endereco, 
                    cidade = :cidade, 
                    estado = :estado, 
                    telefone = :telefone, 
                    ativo = :ativo 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'         => $id,
            ':empresa_id' => $dados['empresa_id'],
            ':nome'       => $dados['nome'],
            ':cnpj'       => $dados['cnpj'] ?? null,
            ':endereco'   => $dados['endereco'] ?? null,
            ':cidade'     => $dados['cidade'] ?? null,
            ':estado'     => $dados['estado'] ?? null,
            ':telefone'   => $dados['telefone'] ?? null,
            ':ativo'      => $dados['ativo'] ?? 1
        ]);
    }

    public function deletar($id) {
        $sql = "DELETE FROM unidades WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
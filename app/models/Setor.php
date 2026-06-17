<?php

class Setor extends Model {

    public function listarTudo() {
        $sql = "SELECT s.*, u.nome AS unidade_nome, e.nome_fantasia AS empresa_nome 
                FROM setores s
                INNER JOIN unidades u ON s.unidade_id = u.id
                INNER JOIN empresas e ON u.empresa_id = e.id
                ORDER BY s.nome ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM setores WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorUnidade($unidade_id) {
        $sql = "SELECT * FROM setores WHERE unidade_id = :unidade_id ORDER BY nome ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':unidade_id' => $unidade_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO setores (unidade_id, nome, descricao) VALUES (:unidade_id, :nome, :descricao)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':unidade_id' => $dados['unidade_id'],
            ':nome'       => $dados['nome'],
            ':descricao'  => $dados['descricao'] ?? null
        ]);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE setores SET unidade_id = :unidade_id, nome = :nome, descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'         => $id,
            ':unidade_id' => $dados['unidade_id'],
            ':nome'       => $dados['nome'],
            ':descricao'  => $dados['descricao'] ?? null
        ]);
    }

    public function deletar($id) {
        $sql = "DELETE FROM setores WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
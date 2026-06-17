<?php

class Cargo extends Model {

    public function listarTudo() {
        $sql = "SELECT c.*, s.nome AS setor_nome, u.nome AS unidade_nome 
                FROM cargos c
                INNER JOIN setores s ON c.setor_id = s.id
                INNER JOIN unidades u ON s.unidade_id = u.id
                ORDER BY c.nome ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM cargos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO cargos (setor_id, nome, cbo, descricao) VALUES (:setor_id, :nome, :cbo, :descricao)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':setor_id'  => $dados['setor_id'],
            ':nome'      => $dados['nome'],
            ':cbo'       => $dados['cbo'] ?? null,
            ':descricao' => $dados['descricao'] ?? null
        ]);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE cargos SET setor_id = :setor_id, nome = :nome, cbo = :cbo, descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'        => $id,
            ':setor_id'  => $dados['setor_id'],
            ':nome'      => $dados['nome'],
            ':cbo'       => $dados['cbo'] ?? null,
            ':descricao' => $dados['descricao'] ?? null
        ]);
    }

    public function deletar($id) {
        $sql = "DELETE FROM cargos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
<?php

class Risco extends Database {
    private $db;

    public function __construct() {
        parent::__construct();
        $this->db = $this->getConnection();
    }

    // Listar todos os riscos (agentes) ou filtrar por tipo de agente (categoria)
    public function listarPorCategoria($tipoAgenteId) {
        $sql = "SELECT a.id, a.nome, a.unidade, a.criado_em, a.atualizado_em, 
                       t.nome AS tipo_nome
                  FROM agentes a
                  INNER JOIN tipos_agentes t ON a.tipo_agente_id = t.id
                 WHERE a.tipo_agente_id = :tipo_agente_id
              ORDER BY a.nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tipo_agente_id', $tipoAgenteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar todos os riscos sem filtro
    public function listarTodos() {
        $sql = "SELECT a.id, a.nome, a.unidade, t.nome AS tipo_nome
                  FROM agentes a
                  INNER JOIN tipos_agentes t ON a.tipo_agente_id = t.id
              ORDER BY t.nome, a.nome";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar risco por ID
    public function buscarPorId($id) {
        $sql = "SELECT a.id, a.nome, a.unidade, t.id AS tipo_agente_id, t.nome AS tipo_nome
                  FROM agentes a
                  INNER JOIN tipos_agentes t ON a.tipo_agente_id = t.id
                 WHERE a.id = :id
                 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir novo risco
    public function inserir($tipoAgenteId, $nome, $unidade = null) {
        $sql = "INSERT INTO agentes (tipo_agente_id, nome, unidade) VALUES (:tipo_agente_id, :nome, :unidade)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tipo_agente_id', $tipoAgenteId, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':unidade', $unidade, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Atualizar risco
    public function atualizar($id, $tipoAgenteId, $nome, $unidade = null) {
        $sql = "UPDATE agentes SET tipo_agente_id = :tipo_agente_id, nome = :nome, unidade = :unidade, atualizado_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tipo_agente_id', $tipoAgenteId, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':unidade', $unidade, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Excluir risco
    public function excluir($id) {
        $sql = "DELETE FROM agentes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

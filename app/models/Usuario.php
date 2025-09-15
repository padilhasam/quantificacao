<?php

class Usuario extends Database {
    private $db;

    public function __construct() {
        parent::__construct();
        $this->db = $this->getConnection();
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Exemplo: listar todos
    public function listarTodos() {
        $stmt = $this->db->query("SELECT id, nome, email, tipo, ativo FROM usuarios ORDER BY nome");
        return $stmt->fetchAll();
    }
}

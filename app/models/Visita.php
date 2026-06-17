<?php

require_once __DIR__ . '/../../core/Database.php';

class Visita {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function listarTodos() {
        // Correção: Trocado tecnicos por usuarios
        $sql = "SELECT 
                    vt.*, 
                    u.nome AS usuario_nome, 
                    v.modelo AS veiculo_modelo, 
                    v.placa AS veiculo_placa,
                    e.razao_social AS empresa_nome,
                    e.nome_fantasia AS empresa_fantasia,
                    uni.nome AS unidade_nome
                FROM visitas_tecnicas vt
                INNER JOIN usuarios u ON vt.usuario_id = u.id
                INNER JOIN empresas e ON vt.empresa_id = e.id
                LEFT JOIN veiculos v ON vt.veiculo_id = v.id
                LEFT JOIN unidades uni ON vt.unidade_id = uni.id
                ORDER BY vt.data_visita DESC, vt.criado_em DESC";
                
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        $sql = "INSERT INTO visitas_tecnicas 
                    (empresa_id, unidade_id, usuario_id, data_visita, hora_visita, veiculo_id, responsavel_acompanhamento, objetivo, observacoes, status) 
                VALUES 
                    (:empresa_id, :unidade_id, :usuario_id, :data_visita, :hora_visita, :veiculo_id, :responsavel_acompanhamento, :objetivo, :observacoes, 'ABERTA')";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':empresa_id'                 => $dados['empresa_id'],
            ':unidade_id'                 => !empty($dados['unidade_id']) ? $dados['unidade_id'] : null,
            ':usuario_id'                 => $dados['usuario_id'],
            ':data_visita'                => $dados['data_visita'],
            ':hora_visita'                => !empty($dados['hora_visita']) ? $dados['hora_visita'] : null,
            ':veiculo_id'                 => !empty($dados['veiculo_id']) ? $dados['veiculo_id'] : null,
            ':responsavel_acompanhamento' => !empty($dados['responsavel_acompanhamento']) ? $dados['responsavel_acompanhamento'] : null,
            ':objetivo'                   => !empty($dados['objetivo']) ? $dados['objetivo'] : null,
            ':observacoes'                => !empty($dados['observacoes']) ? $dados['observacoes'] : null
        ]);
    }
}
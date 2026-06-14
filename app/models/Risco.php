<?php

class Risco extends Database
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->getConnection();
    }

    // LISTAR TODOS
    public function listarTodos(): array
    {
        $sql = "SELECT r.id,
                       r.nome,
                       r.descricao,
                       r.unidade_medida,
                       r.exige_quantificacao,
                       r.severidade_padrao,
                       t.nome AS tipo_nome
                  FROM riscos r
                  INNER JOIN tipos_riscos t ON r.tipo_risco_id = t.id
              ORDER BY t.nome, r.nome";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // LISTAR POR TIPO
    public function listarPorCategoria(int $tipoRiscoId): array
    {
        $sql = "SELECT r.id,
                       r.nome,
                       r.descricao,
                       r.unidade_medida,
                       r.exige_quantificacao,
                       r.severidade_padrao,
                       t.nome AS tipo_nome
                  FROM riscos r
                  INNER JOIN tipos_riscos t ON r.tipo_risco_id = t.id
                 WHERE r.tipo_risco_id = :tipo_risco_id
              ORDER BY r.nome";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':tipo_risco_id', $tipoRiscoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR POR ID
    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT r.id,
                       r.nome,
                       r.descricao,
                       r.unidade_medida,
                       r.exige_quantificacao,
                       r.severidade_padrao,
                       r.tipo_risco_id,
                       t.nome AS tipo_nome
                  FROM riscos r
                  INNER JOIN tipos_riscos t ON r.tipo_risco_id = t.id
                 WHERE r.id = :id
                 LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // INSERIR
    public function inserir(
        int $tipoRiscoId,
        string $nome,
        string $descricao = '',
        string $unidade = '',
        int $exigeQuantificacao = 0,
        int $severidade = 1
    ): bool {
        $sql = "INSERT INTO riscos
                (tipo_risco_id, nome, descricao, unidade_medida, exige_quantificacao, severidade_padrao)
                VALUES
                (:tipo_risco_id, :nome, :descricao, :unidade_medida, :exige_quantificacao, :severidade_padrao)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':tipo_risco_id' => $tipoRiscoId,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':unidade_medida' => $unidade,
            ':exige_quantificacao' => $exigeQuantificacao,
            ':severidade_padrao' => $severidade
        ]);
    }

    // ATUALIZAR
    public function atualizar(
        int $id,
        int $tipoRiscoId,
        string $nome,
        string $descricao = '',
        string $unidade = '',
        int $exigeQuantificacao = 0,
        int $severidade = 1
    ): bool {
        $sql = "UPDATE riscos
                   SET tipo_risco_id = :tipo_risco_id,
                       nome = :nome,
                       descricao = :descricao,
                       unidade_medida = :unidade_medida,
                       exige_quantificacao = :exige_quantificacao,
                       severidade_padrao = :severidade_padrao
                 WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':tipo_risco_id' => $tipoRiscoId,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':unidade_medida' => $unidade,
            ':exige_quantificacao' => $exigeQuantificacao,
            ':severidade_padrao' => $severidade
        ]);
    }

    // EXCLUIR
    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM riscos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
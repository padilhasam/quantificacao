<?php

require_once __DIR__ . '/../../core/Database.php';

class Empresa
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Lista todas as empresas
     */
    public function listar(): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM empresas
            ORDER BY COALESCE(nome_fantasia, razao_social) ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lista apenas empresas ativas
     */
    public function listarAtivas(): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM empresas
            WHERE ativo = 1
            ORDER BY COALESCE(nome_fantasia, razao_social) ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca empresa por ID
     */
    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM empresas
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Busca empresa por código
     */
    public function buscarPorCodigo(string $codigo): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM empresas
            WHERE codigo = :codigo
            LIMIT 1
        ");

        $stmt->bindValue(':codigo', $codigo);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Busca empresa por CNPJ
     */
    public function buscarPorCnpj(string $cnpj): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM empresas
            WHERE cnpj = :cnpj
            LIMIT 1
        ");

        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Salva empresa
     */
    public function salvar(array $dados)
    {
        $sql = "
            INSERT INTO empresas (
                codigo,
                codigo_externo,
                razao_social,
                nome_fantasia,
                cnpj,
                inscricao_estadual,
                telefone,
                email,
                responsavel,
                contato_responsavel,
                endereco,
                cidade,
                estado,
                cep,
                ativo
            ) VALUES (
                :codigo,
                :codigo_externo,
                :razao_social,
                :nome_fantasia,
                :cnpj,
                :inscricao_estadual,
                :telefone,
                :email,
                :responsavel,
                :contato_responsavel,
                :endereco,
                :cidade,
                :estado,
                :cep,
                :ativo
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':codigo', $dados['codigo'] ?? null);
        $stmt->bindValue(':codigo_externo', $dados['codigo_externo'] ?? null);
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

        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }

        return false;
    }

    /**
     * Atualiza empresa
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = "
            UPDATE empresas SET
                codigo = :codigo,
                codigo_externo = :codigo_externo,
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
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':codigo', $dados['codigo'] ?? null);
        $stmt->bindValue(':codigo_externo', $dados['codigo_externo'] ?? null);
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

    /**
     * Desativação lógica
     */
    public function desativar(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE empresas
            SET ativo = 0
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
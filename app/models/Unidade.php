<?php

class Unidade extends Model
{
    public function listarTudo()
    {
        $sql = "
            SELECT *
            FROM unidades
            ORDER BY nome ASC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarAtivas()
    {
        $sql = "
            SELECT *
            FROM unidades
            WHERE ativo = 1
            ORDER BY nome ASC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id)
    {
        $sql = "
            SELECT *
            FROM unidades
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorCodigo(string $codigo)
    {
        $sql = "
            SELECT *
            FROM unidades
            WHERE codigo = :codigo
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':codigo' => $codigo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorCnpj(string $cnpj)
    {
        $sql = "
            SELECT *
            FROM unidades
            WHERE cnpj = :cnpj
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':cnpj' => $cnpj
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar(array $dados)
    {
        $sql = "
            INSERT INTO unidades (
                codigo,
                codigo_externo,
                nome,
                cnpj,
                endereco,
                numero,
                bairro,
                cidade,
                estado,
                cep,
                telefone,
                email,
                responsavel,
                ativo
            ) VALUES (
                :codigo,
                :codigo_externo,
                :nome,
                :cnpj,
                :endereco,
                :numero,
                :bairro,
                :cidade,
                :estado,
                :cep,
                :telefone,
                :email,
                :responsavel,
                :ativo
            )
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':codigo'          => $dados['codigo'] ?? null,
            ':codigo_externo' => $dados['codigo_externo'] ?? null,
            ':nome'           => $dados['nome'],
            ':cnpj'           => $dados['cnpj'] ?? null,
            ':endereco'       => $dados['endereco'] ?? null,
            ':numero'         => $dados['numero'] ?? null,
            ':bairro'         => $dados['bairro'] ?? null,
            ':cidade'         => $dados['cidade'] ?? null,
            ':estado'         => $dados['estado'] ?? null,
            ':cep'            => $dados['cep'] ?? null,
            ':telefone'       => $dados['telefone'] ?? null,
            ':email'          => $dados['email'] ?? null,
            ':responsavel'    => $dados['responsavel'] ?? null,
            ':ativo'          => $dados['ativo'] ?? 1
        ]);

        return $this->db->lastInsertId();
    }

    public function atualizar(int $id, array $dados)
    {
        $sql = "
            UPDATE unidades SET
                codigo = :codigo,
                codigo_externo = :codigo_externo,
                nome = :nome,
                cnpj = :cnpj,
                endereco = :endereco,
                numero = :numero,
                bairro = :bairro,
                cidade = :cidade,
                estado = :estado,
                cep = :cep,
                telefone = :telefone,
                email = :email,
                responsavel = :responsavel,
                ativo = :ativo
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'             => $id,
            ':codigo'         => $dados['codigo'] ?? null,
            ':codigo_externo' => $dados['codigo_externo'] ?? null,
            ':nome'           => $dados['nome'],
            ':cnpj'           => $dados['cnpj'] ?? null,
            ':endereco'       => $dados['endereco'] ?? null,
            ':numero'         => $dados['numero'] ?? null,
            ':bairro'         => $dados['bairro'] ?? null,
            ':cidade'         => $dados['cidade'] ?? null,
            ':estado'         => $dados['estado'] ?? null,
            ':cep'            => $dados['cep'] ?? null,
            ':telefone'       => $dados['telefone'] ?? null,
            ':email'          => $dados['email'] ?? null,
            ':responsavel'    => $dados['responsavel'] ?? null,
            ':ativo'          => $dados['ativo'] ?? 1
        ]);
    }

    public function desativar(int $id)
    {
        $sql = "
            UPDATE unidades
            SET ativo = 0
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
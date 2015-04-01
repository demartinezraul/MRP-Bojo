<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 22:40
 */

abstract class DataAccessObject
{
    protected $success = false;
    protected $resultado;
    protected $numRegistros;
    protected $dataTransfer;

    /** @var PDOStatement */
    protected $statement;

    protected $tabela; // tabela referente ao model
    protected $primaryKey; // chave primária da tabela
    /** @var  PDO */
    protected $con;

    public function __construct()
    {
        $this->con = Database::getConnection();
    }

    /**
     * @return mixed
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param DataTransferObject $dto
     * @return bool | DataTransferObject
     */
    protected function insert(DataTransferObject $dto)
    {
        $reflex = $dto->getReflex();
        unset($reflex[$this->primaryKey]);

        $colunas = implode(', ', array_keys($reflex));
        $campos = ':' . implode(', :', array_keys($reflex));

        $sql = "INSERT INTO {$this->tabela} ({$colunas})
                VALUES ({$campos}) returning *";

        foreach ($dto->getReflex() as $atributo => $method) {
            if ($atributo != $this->primaryKey) {
                $dados[$atributo] = $dto->{$method}();
            }
        }

        if ($this->query($sql, $this->dataTransfer, $dados)->success()) {
            return $this->getResultado()[0];
        }
        return false;
    }

    /**
     * @param DataTransferObject $dto
     * @return bool| DataTransferObject
     */
    protected function update(DataTransferObject $dto)
    {
        foreach ($dto->getReflex() as $atributo => $method) {
            if ($atributo != 'cd_usuario_criacao'
                && $atributo != 'dt_usuario_criacao'
            ) {
                $parametros[] = $atributo . ' = :' . $atributo;
            }
        }
        $parametros = implode(', ', $parametros);

        $sql = "UPDATE {$this->tabela}
                SET {$parametros}
                WHERE {$this->primaryKey} = :{$this->primaryKey} returning *";

        foreach ($dto->getReflex() as $atributo => $method) {
            if ($atributo != 'cd_usuario_criacao' && $atributo != 'dt_usuario_criacao') {
                $dados[$atributo] = $dto->{$method}();
            }
        }

        if ($this->query($sql, $this->dataTransfer, $dados)->success()) {
            return $this->getResultado()[0];
        }
        return false;
    }

    /**
     * @param null $where
     * @param null $limit
     * @param null $offset
     * @param null $orderby
     * @return bool| DataTransferObject
     */
    public function select($where = null, $limit = null, $offset = null, $orderby = null)
    {
        $where = ($where != null ? " WHERE {$where}" : "");
        $limit = ($limit != null ? " LIMIT {$limit}" : "");
        $offset = ($offset != null ? " OFFSET {$offset}" : "");
        $orderby = ($orderby != null ? " ORDER BY {$orderby}" : "");

        $sql = "SELECT *
                FROM {$this->tabela}{$where}{$limit}{$offset}{$orderby}";

        if ($this->query($sql, $this->dataTransfer, array())->success()) {
            return $this->getResultado();
        }
        return false;
    }

    /**
     * @param $where
     * @return bool | DataTransferObject
     */
    public function get($where)
    {
        return $this->select($where, null, null, null);
    }

    /**
     * @param $id
     * @return DataTransferObject
     */
    public function getById($id)
    {
        $this->resultado = $this->get("{$this->primaryKey} = {$id}");

        if ($this->resultado) {
            return $this->resultado[0];
        }

        return false;
    }

    /**
     * @param DataTransferObject $dto
     * @return bool | DataTransferObject
     */
    public function delete(DataTransferObject $dto)
    {
        $sql = "DELETE FROM {$this->tabela}
                WHERE {$this->primaryKey} = {$dto->{$dto->getReflex()[$this->primaryKey]}()}  returning *";

        if ($this->query($sql, $this->dataTransfer, array())->success()) {
            return $this->first();
        }
        return false;
    }

    /**
     * @param string $sql = SQL para ser preparada
     * @param string $obj = Nome da Classe DTO
     * @param array $parametros = dados a serem enviados para o banco de dados
     * @return $this
     */
    protected function query($sql, $obj, array $parametros)
    {
        try {
            $this->statement = $this->con->prepare($sql);
            if (count($parametros)) {
                $this->statement->execute($parametros);
            } else {
                $this->statement->execute();
            }

            $this->resultado = $this->statement->fetchAll(PDO::FETCH_CLASS, $this->dataTransfer);
            $this->numRegistros = $this->statement->rowCount();
            $this->success = true;
        } catch (PDOException $e) {
            $this->success = false;
            CodeFail((int)$e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function success()
    {
        return $this->success;
    }

    /**
     * @return DataTransferObject
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * @return bool| DataTransferObject
     */
    public function fullList()
    {
        return $this->select(null, null, null, "{$this->primaryKey} DESC");

    }

    /**
     * Retorna primeiro objeto resultante da consulta ao banco de dados
     * @return DataTransferObject
     */
    public function first()
    {
        return $this->resultado[0];
    }

    /**
     * @return int $numregistros = numero de registros retornados da query
     */
    public function getNumRegistros()
    {
        return $this->numRegistros;
    }
}
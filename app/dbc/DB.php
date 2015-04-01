<?php

/**
 * Created by PhpStorm.
 * Usuario: Vinicius
 * Date: 26/07/14
 * Time: 18:25
 */
class DB
{
    private $success = false;
    private $resultado;
    private $numregistros;

    /** @var PDOStatement */
    private $statement;

    /** @var PDO */
    private $pdo;

    /** @var PDO */
    private static $instance = null;

    /**
     * Cria uma conexão ao banco de dados e atribui ao campo $pdo
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                Config::get('database/sgbd') . ':host=' .
                Config::get('database/host') . ';dbname=' .
                Config::get('database/dbname'),
                Config::get('database/user'),
                Config::get('database/pass'));
        } catch (PDOException $e) {
            CodeFail((int)$e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Retorna a conexão ativa ou cria uma, caso ela não exista
     * @return DB|PDO
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    /**
     * @param string $tabela = entidade do banco de dados
     * @param array $dados = dados para serem inseridos
     * @return bool
     */
    public function insert($tabela, $dados = array())
    {
        $colunas = implode(', ', array_keys($dados));
        $aliases = ':' . implode(', :', array_keys($dados));

        $sql = "INSERT INTO {$tabela} ($colunas) VALUES ({$aliases}) returning *";

        if ($this->query($sql, $dados)->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $tabela = entidade do banco de dados
     * @param $where
     * @param array $dados
     * @return bool
     */
    public function update($tabela, $dados = array(), $where)
    {
        foreach ($dados as $parametro => $valor) {
            $parametros[] = $parametro . ' = :' . $parametro;
        }

        $parametros = implode(', ', $parametros);
        $sql = "UPDATE {$tabela} SET {$parametros} WHERE {$where} returning *";

        if ($this->query($sql, $dados)->success()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $tabela = entidade do banco de dados
     * @param string $colunas = colunas selecionadas, informe null para retornar todas
     * @param string $where = informe null para não usar este campo
     * @param string $limit = informe null para não usar este campo
     * @param string $offset = informe null para não usar este campo
     * @param string $orderby = informe null para não usar este campo
     * @return boolean
     */
    public function select($colunas = null, $tabela, $where = null, $limit = null, $offset = null, $orderby = null)
    {
        $colunas = ($colunas != null ? " {$colunas}" : "*");
        $where = ($where != null ? " WHERE {$where}" : "");
        $limit = ($limit != null ? " LIMIT {$limit}" : "");
        $offset = ($offset != null ? " OFFSET {$offset}" : "");
        $orderby = ($orderby != null ? " ORDER BY {$orderby}" : "");

        $sql = "SELECT {$colunas} FROM {$tabela}{$where}{$limit}{$offset}{$orderby}";

        if ($this->query($sql, array())->success()) {
            return $this;
        }
        return false;
    }

    public function join($tabela, $coluna)
    {
        /**
        select tb_item.ds_item, tb_estoque.quantidade
        from tb_item, tb_estoque
        where tb_item.id_item = tb_estoque.id_item
         */

        $this->select('');
    }
    /**
     *
     * @param string $table = Tabela do Banco de Dados
     * @param string $where = Condição para query
     * @return boolean
     */
    public function get($table, $where) {
        return $this->select(null,$table, $where, null, null, null);
    }

    /**
     * @param string $tabela = entidade do banco de dados
     * @param string $where = condição para deletar registro
     * @return bool
     */
    public function delete($tabela, $where)
    {
        $where = ($where != null ? " WHERE {$where}" : "");
        $sql = "DELETE FROM {$tabela}{$where} returning *";
        if ($this->query($sql, array())->success()) {
            return $this;
        }
        return false;
    }

    /**
     * @return mixed = resultado da query
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Retorna primeiro objeto resultante da consulta ao banco de dados
     * @return PDO::FETCH_ASSOC
     */
    public function first() {
        return $this->resultado[0];
    }

    /**
     * @return int $numregistros = numero de registros retornados da query
     */
    public function getNumRegistros()
    {
        return $this->numregistros;
    }


    /**
     * @param string $sql = SQL para ser preparada
     * @param array $parametros = dados a serem enviados para o banco de dados
     * @return $this
     */
    private function query($sql, array $parametros)
    {
        try {
            $this->statement = $this->pdo->prepare($sql);
            if (count($parametros)) {
                $this->statement->execute($parametros);
            } else {
                $this->statement->execute();
            }
            $this->resultado = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            $this->numregistros = $this->statement->rowCount();
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
    private function success()
    {
        return $this->success;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
<?php

abstract class Database {
    /** @var PDO */
    private static $pdo;

    /** @var PDO */
    private static $instance = null;

    private function __construct(){}

    private static function connect()
    {
        try {
            self::$pdo = new PDO(
                Config::get('database/sgbd') . ':host=' .
                Config::get('database/host') . ';dbname=' .
                Config::get('database/dbname'),
                Config::get('database/user'),
                Config::get('database/pass'));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$pdo;
        } catch (PDOException $e) {
            CodeFail((int)$e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
    }

    /**
     * Retorna a conexão ativa ou cria uma, caso ela não exista
     * @return DB|PDO
     */
    public static function getConnection()
    {
        if (!isset(self::$instance)) {
            self::$instance = self::connect();
        }
        return self::$instance;
    }
} 
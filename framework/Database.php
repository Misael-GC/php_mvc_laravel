<?php

namespace Framework;
use PDO;

class Database
{
    private static $instance = null;
    private $pdo;
    private $stmt;

    private function __construct()
    {
        // $dsn = 'mysql:host=localhost;dbname=web_php;charset=utf8mb4';
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            config('host', 'localhost'),
            config('database', 'web_php'),
            config('charset', 'utf8mb4')
        );
        // var_dump($dsn); die();
        $this->pdo = new PDO($dsn, config('user'), config('password'), config('options', []));
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function query($sql, $params = []){
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this;
    }

    public function get(){
        return $this->stmt->fetchAll();
    }

    public function firstOrFail(){
        $result = $this->stmt->fetch();
        if (!$result) {
            http_response_code(404);
            echo '404 Not Found';
            exit;
        }
        return $result;
    }
}
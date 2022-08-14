<?php

class Database
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Установка соединения с базой данных из параметров config файла
     * @return $this
     */
    private function connect(): Database
    {
        $config = require_once 'config.php';

        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['charset'];

        $this->link = new PDO($dsn, $config['user'], $config['password']);

        return $this;
    }

    /**
     * Выполняет запрос к БД
     * @param $sqlQuery
     * @return mixed
     */
    public function execute($sqlQuery):bool
    {
        $request = $this->link->prepare($sqlQuery);
        return $request->execute();
    }

    /**
     * Выполняет выборку из БД и возвращает массив с данными
     * @param $sqlQuery
     * @return array
     */
    public function query($sqlQuery): array
    {
        $request = $this->link->prepare($sqlQuery);

        $request->execute();

        $result = $request->fetchALL(PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return $result;
    }

}
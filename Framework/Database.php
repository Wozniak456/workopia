<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;

class Database
{
    public $conn;

    /**
     * Constructor for Database class
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};";

        //параметри конфігурації PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Налаштовує режим обробки помилок у PDO. Встановлює режим, у якому будь-яка помилка PDO буде спричиняти викидання виключення (Exception)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ //Визначає спосіб отримання рядків із бази даних. Повертає результати у вигляді об'єктів, де кожен стовпець у базі даних стає властивістю цього об'єкта.
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            // echo 'connected';
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Exucute any query to the db
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement || PDOException
     */
    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            //bind named params. Захист від SQL-ін'єкцій через використання параметризованих запитів 
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}

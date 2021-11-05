<?php

include("config.php");

class DBQueries
{
	protected $pdo;

    public function __construct() {
        $dbName = Config::$dbName;
        $host = Config::$host;
        
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", 
            Config::$username, Config::$password);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function raw($rawSql)
    {
        $statement = $this->pdo->prepare($rawSql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insertData($table, $parameters){
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            echo $e;
        }
        return $pdo->lastInsertId();
    }
    
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
}
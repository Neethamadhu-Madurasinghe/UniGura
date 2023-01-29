<?php

class Database {
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $password = DB_PASSWORD;
    private string $dbname = DB_NAME;

    private PDO $dbh;
    private PDOStatement $statement;
    private string $error;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

//        Instantiate PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

//    Prepare the statement
    public function query($sql): void {
        $this->statement = $this->dbh->prepare($sql);
    }

//    Bind parameters
    public function bind($param, $value, $type = null): void {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        $this->statement->bindValue($param, $value, $type);
    }

//    Execute the prepared statement
    public function execute(array $params = []): bool {
        if ($params) {
            foreach ($params as $param) {
                $this->bind($param[0], $param[1], $param[2]);
            }
        }

        return $this->statement->execute();
    }

//    Get multiple records as the result
    public function resultAll(): array {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

//    Get multiple records as the result in associative array format
    public function resultAllAssoc(): array {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

//    Get single record as the result
    public function resultOne() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

//    Get the number of rows in the result
    public function rowCount(): int {
        return $this->statement->rowCount();
    }

//    Get the id of the latest insertion
    public function lastId(): string {
        return $this->dbh->lastInsertId();
    }

//    Start a transaction
    public function startTransaction() {
        $this->dbh->beginTransaction();
    }

//    Commit a transaction
    public function commitTransaction(): bool {
        try {
            $this->dbh->commit();
            return true;

        }catch (Exception $e) {
            $this->dbh->rollBack();
            return false;
        }
    }
}

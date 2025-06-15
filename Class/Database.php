<?php 

class Database {
    private $host = 'localhost';
    private $db_name = 'db_project_mngmnt';
    private $username = 'root';
    private $password = '';
    public $conn;

    private $table_name;

    private $query;
    private $parameters = [];
    private $stmt;

    // Get the database connection
    public function connect($table_name) {
        $this->conn = null;
        $this->table_name = $table_name;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setParameters($parameters) {
        $this->parameters = $parameters;
    }

    public function executeQuery() {
        $this->stmt = $this->conn->prepare($this->query);
        $this->stmt->execute($this->parameters);
    }

    public function fetchAll() {
        $this->executeQuery($this->parameters);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchSingle() {
        $this->executeQuery($this->parameters);
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRowCount() {
        return $this->stmt->rowCount();
    }

    public function sqlInsert($parameters) {
        $query = 'INSERT INTO '.$this->table_name.' ('.implode(',', array_keys($parameters)).') VALUES ';

        // build parameterized columns
        $x = 1;
        $column_count = count($parameters);
        $query_parameterized = [];
        while($x <= $column_count ){
            $query_parameterized[] = "?";
            $x++;
        }

        $query .= ' ('.implode(',', $query_parameterized).') ';

        $this->setQuery($query);
        $this->setParameters(array_values($parameters));
        return $this->executeQuery();
    }
}
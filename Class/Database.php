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

    private $select_query;
    private $update_query;

    public function __construct($table_name) {
        $this->table_name = $table_name;

        $this->setDefaultQuery();
        $this->connect();
    }

    public function setDefaultQuery() {
        $this->select_query = 'SELECT * FROM '.$this->table_name;
        $this->update_query = 'UPDATE '.$this->table_name.' SET ';
    }

    // Get the database connection
    public function connect() {
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
        if (!$this->conn) {
            throw new \Exception("Database connection is not established.");
        }
        $this->stmt = $this->conn->prepare($this->query);
        return $this->stmt->execute($this->parameters);
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

        $query .= '('.implode(',', $query_parameterized).') ';

        $this->setQuery($query);
        $this->setParameters(array_values($parameters));
        return $this->executeQuery();
    }

    public function sqlSelect($condition = null){
        $this->select_query = 'SELECT * FROM '.$this->table_name;
        $this->parameters = array();
        
        $this->buildSelectWhereClause($condition);
        return $this;
    }

    public function sqlUpdate($parameters, $condition = null){
        $this->update_query = 'UPDATE '.$this->table_name.' SET ';

        // build parameterized columns
        $x = 1;
        $column_count = count($parameters);
        $query_parameterized = [];
        while($x <= $column_count ){
            $query_parameterized[] = key($parameters) . ' = ?';
            next($parameters);
            $x++;
        }

        $this->update_query .= implode(',', $query_parameterized);

        if ($condition) {
            $this->buildSelectWhereClause($condition);
        }

        $this->setQuery($this->update_query);
        $this->setParameters(array_values($parameters));
        
        return $this->executeQuery();
    }

    public function sqlDelete($id){
        $this->setQuery('DELETE FROM '.$this->table_name.' WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }

    public function sqlFetchAll($condition = null){
        $this->buildSelectWhereClause($condition);
        $this->setQuery($this->select_query);
        $this->executeQuery();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function sqlFetchSingle($condition = null){
        $this->buildSelectWhereClause($condition);
        $this->setQuery($this->select_query);
        $this->executeQuery();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function sqlFetchById($id){
        $this->setQuery($this->select_query.' WHERE id = ?');
        $this->setParameters(array($id));
        $this->executeQuery();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function buildSelectWhereClause($conditions){

        if($conditions != null){

            foreach($conditions as $key => $condition){

                $logical_operator = 'WHERE';

                if( strpos($this->select_query, 'WHERE') !== false ){
                    $logical_operator = 'AND';
                }

                $query_condition = ' ' . $logical_operator . ' ' . $condition['column_name'] . ' ' .$condition['operator'] . ' ?';
                $this->select_query .= $query_condition;

                // set parameter value
                $this->parameters[] = $condition['value'];
            }
        }
    }
}
<?php 

class Database {
    private $host = 'localhost';
    private $db_name = 'db_project_mngmnt';
    private $username = 'root';
    private $password = '';
    public $conn;

    private $fetchMode;
    private $table_name;

    private $query;
    private $parameters = [];
    private $stmt;

    private $select_query;
    private $update_query;
    private $columns = [];

    public function __construct($table_name, $columns = []) {
        $this->table_name = $table_name;
        $this->columns = $columns;

        $this->setDefaultQuery();
        $this->connect();

        $this->fetchMode = \PDO::FETCH_ASSOC;
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

    public function sqlSelect($columns = []){

        $query_columns = $this->getTableColumns();
        foreach ($columns as $column) {
           array_push($query_columns, $column); 
        }

        $this->select_query = 'SELECT '.implode(',',$query_columns).' FROM '.$this->table_name;
        $this->parameters = array();
        
        return $this;
    }

    public function sqlUpdate($parameters, $condition = null){
        // build parameterized columns
        $x = 1;
        $query_parameters = [];
        foreach($parameters as $key => $parameter){
            if ($key != 'id') {

                $this->update_query .= $key . ' = ?';
                $query_parameters[] = $parameter;

                if ($x < (count($parameters) - 1) ) $this->update_query .= ', ';
            }

            if($key === 'id' && $x === 1){
                continue;
            }
            $x++;
        }

        $this->update_query .= ' WHERE id = ?';

        $query_parameters[] = $parameters['id'];

        $this->setQuery($this->update_query);
        $this->setParameters($query_parameters);
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

    public function where($condition){
        $this->buildSelectWhereClause(['where' => $condition]);

        return $this;
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

    public function join($table, $onCondition, $joinType = 'INNER JOIN') {
        $this->select_query .= " $joinType $table ON $onCondition";
        return $this;
    }

    public function get(){
        $this->setQuery($this->select_query);
        $this->setParameters($this->parameters);
        return $this->fetch();
    }

    public function getAll(){
        $this->setQuery($this->select_query);

        if($this->parameters){
            $this->setParameters($this->parameters);
        }

        return $this->fetchAll();
    }

    public function fetch(){
        $this->executeQuery();
        return $this->stmt->fetch($this->fetchMode);
    }

    public function getTableColumns(){
        $select_columns = [];
        foreach ($this->columns as $column) {
            array_push($select_columns, $this->table_name.'.'.$column);
        }
        return $select_columns;
    }
}
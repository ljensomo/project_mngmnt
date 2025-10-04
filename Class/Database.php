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

    private $isSelectQuery = false;
    private $isUpdateQuery = false;

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
        $this->reset();

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
        $this->setQuery($this->select_query);
        $this->executeQuery();    
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

        $this->isSelectQuery = true;

        $query_columns = $this->getTableColumns();
        foreach ($columns as $column) {
           array_push($query_columns, $column); 
        }

        $this->select_query = 'SELECT '.implode(',',$query_columns).' FROM '.$this->table_name;
        $this->parameters = array();
        
        return $this;
    }

    public function sqlUpdate($parameters, $conditions = null){

        $this->isUpdateQuery = true;
        // build parameterized columns
        $x = 1;
        $this->parameters = [];
        foreach($parameters as $key => $parameter){
            if ($key != 'id') {

                $this->update_query .= $key . ' = ?';
                $this->parameters[] = $parameter;

                if ($x < (count($parameters) - 1) ) $this->update_query .= ', ';
            }else{
                $this->where(['column_name' => 'id', 'operator' => '=', 'value' => $parameter]);
            }

            $x++;
        }

        if($conditions != null){
            foreach($conditions as $key => $condition){
                switch($key){
                    case 'where':
                        $this->where($condition);
                        break;
                    case 'and':
                        $this->andWhere($condition);
                        break;
                    case 'or':
                        $this->orWhere($condition);
                        break;
                }
            }
        }

        $this->setQuery($this->update_query);
        return $this->executeQuery();
    }

    public function sqlDelete($id){
        $this->setQuery('DELETE FROM '.$this->table_name.' WHERE id = ?');
        $this->setParameters([$id]);
        return $this->executeQuery();
    }

    public function sqlFetchAll($condition = null){
        $this->buildWhereClause($condition);
        $this->setQuery($this->select_query);
        $this->executeQuery();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function sqlFetchSingle($condition = null){
        $this->buildWhereClause($condition);
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
        $this->buildWhereClause(['where' => $condition]);

        return $this;
    }

    public function andWhere($condition){
        $this->buildWhereClause(['and' => $condition]);

        return $this;
    }

    public function orWhere($condition){
        $this->buildWhereClause(['or' => $condition]);

        return $this;
    }

    public function buildWhereClause($conditions){

        if($conditions != null){

            foreach($conditions as $key => $condition){

                $logical_operator = $key;

                if(!array_key_exists('operator', $condition)){
                    $condition['operator'] = '=';
                }

                $query_condition = ' ' . $logical_operator . ' ' . $condition['column_name'] . ' ' .$condition['operator'] . ' ?';
                if($this->isSelectQuery){
                    $this->select_query .= $query_condition;
                }else if($this->isUpdateQuery){
                    $this->update_query .= $query_condition;
                }

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
        return $this->fetch();
    }

    public function getAll(){
        $this->setQuery($this->select_query);

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

    public function reset() {
        $this->isSelectQuery = false;
        $this->isUpdateQuery = false;

        $this->resetQuery();
    }

    public function resetQuery() {
        $this->select_query = 'SELECT * FROM '.$this->table_name;
        $this->update_query = 'UPDATE '.$this->table_name.' SET ';
    }
}
<?php 

class User extends Database {

    const TABLE_NAME = 'users';

    private $first_name;
    private $last_name;
    private $username;
    private $password;

    public function __construct() {
        $this->connect(self::TABLE_NAME);
    }

    public function setFirstname($fname) {
        $this->first_name = $fname;
    }

    public function setLastname($lname) {
        $this->last_name = $lname;
    }

    public function setUsername() {
        $firstName = explode(' ', $this->first_name);

        foreach($firstName as $name){
            $this->username .= substr($name, 0, 1);
        }

        $this->username .= str_replace( ' ', '', $this->last_name);
        $this->username = strtolower($this->username);

        $name_count = $this->getUserNameCount();

        $this->username .= $name_count > 0 ? $name_count+1 : '';
    }

    public function setPassword() {
        $this->password = password_hash('password123', PASSWORD_BCRYPT);
    }

    public function add() {
        return $this->sqlInsert([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'password' => $this->password
        ]);
    }

    public function getUserNameCount(){
        $this->setQuery('SELECT id FROM users WHERE first_name = ? AND last_name = ?');
        $this->setParameters([
            $this->first_name,
            $this->last_name
        ]);
        $this->executeQuery();

        return $this->getRowCount();
    }
}
<?php

class Login extends Database {
    private $username;
    private $password;

    private $columns = [
        'id',
        'first_name',
        'last_name',
        'username',
        'password',
        'date_created'
    ];

    private $error_message;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;

        parent::__construct('users', $this->columns);
    }

    private function setErrorMessage($message) {
        $this->error_message = $message;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

    public function authenticate() {
        
        $user = $this->sqlSelect()->where([
                'column_name' => 'username',
                'value' => $this->username
            ])->get();

        if($user){
            if(password_verify($this->password, $user['password'])) {
                return $user; // Authentication successful
            } else {
                $this->setErrorMessage('Invalid password inputted.');
                return false;
            }
        } else {
            $this->setErrorMessage('User not found.');
            return false;
        }
    }
}
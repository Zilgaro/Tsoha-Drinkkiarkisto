<?php

class Client extends BaseModel {

	public $id, $name, $password;

	public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password');
    }

    public static function all(){
        
        $query = DB::connection()->prepare('SELECT * FROM Client');
        $query->execute();
        $rows = $query->fetchAll();
        
        $clients = array();

        foreach($rows as $row) {
            $clients[] = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
                ));
        }
        return $clients;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $client = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $client;
        }
        return null;
    }

    public function authenticate($name, $password) {
    	$query = DB::connection()->prepare('SELECT * FROM Client WHERE name = :name AND password = :password LIMIT 1');
    	$query->execute(array('name'=> $name, 'password'=>$password));
    	$row = $query->fetch();
    	if ($row) {
            $client = new Client(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $client;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Client (name, password) VALUES (:name, :password) RETURNING id');

        $query->execute(array('name' => $this->name, 'password' => $this->password));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function checkAvailable($name) {
        $clients = $this->all();

        foreach ($clients as $client) { 
            if ($client->$name == $name) {
                return false;
            }
        }
        return true;
    }

    public function validate_username() {
        $errors = array();
        
        if ($this->validate_string_not_empty_or_null($this->name)) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }

        $length = 3;
        if ($this->validate_string_brevity($this->name, $length)) {
            $errors[] = 'Nimi ei saa olla alle ' . $length . ' merkkiä pitkä!';
        }

        $length = 16;
        if ($this->validate_string_length($this->name, $length)) {
            $errors[] = 'Nimi ei saa olla yli ' . $length . ' merkkiä pitkä!';
        }
        return $errors;
    }

    public function validate_password() {
        $errors = array();
        
        if ($this->validate_string_not_empty_or_null($this->password)) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }

        $length = 6;
        if ($this->validate_string_brevity($this->password, $length)) {
            $errors[] = 'Salasana ei saa olla alle ' . $length . ' merkkiä pitkä!';
        }

        $length = 24;
        if ($this->validate_string_length($this->name, $length)) {
            $errors[] = 'Salasana ei saa olla yli ' . $length . ' merkkiä pitkä!';
        }
        return $errors;
    }
    }
}
<?php

class Client extends BaseModel {

	public $id, $name, $password;

	 public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
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
}
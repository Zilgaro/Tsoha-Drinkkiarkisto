<?php

class Drink extends BaseModel{
	
	public $id, $name, $glass, $drink_type, $description;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function all(){
		
		$query = DB::connection()->prepare('SELECT * FROM Drink');
		$query->execute();
		$rows = $query->fetchAll();
		
		$drinks = array();

		foreach($rows as $row) {
			$drinks[] = new Drink(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'glass' => $row['glass'],
				'drink_type' => $row['drink_type'],
				'description' => $row['description']
				));
		}
		return $drinks;
	}

	public static function find($id) {
		
		$query = DB::connection()->prepare('SELECT * FROM Drink WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
    		$drink = new Drink(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'glass' => $row['glass'],
				'drink_type' => $row['drink_type'],
				'descripton' => $row['description']
				));
    		return $drink;
    	}
    	return null;
	}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Drink (name, glass, drink_type, description) VALUES (:name, :glass, :drink_type, :desc) RETURNING id');

		$query->execute(array('name' => $this->name, 'glass' => $this->glass, 'drink_type' => $this->drink_type, 'description' => $this->description));

		$row = $query->fetch();

		$this->id = $row['id'];
	}
}
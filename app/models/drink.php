<?php

class Drink extends BaseModel{
	
	public $id, $name, $glass, $drink_type, $desc;

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
				'desc' => $row['description']
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
				'desc' => $row['description']
				));
    		return $drink;
    	}
    	return null;
	}
}
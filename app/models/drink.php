<?php

class Drink extends BaseModel{
	
	public $id, $name, $glass, $drink_type, $description;

	public function __construct($attributes) {
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_glass','validate_drink_type', 'validate_description');

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
		$query = DB::connection()->prepare('INSERT INTO Drink (name, glass, drink_type, description) VALUES (:name, :glass, :drink_type, :description) RETURNING id');

		$query->execute(array('name' => $this->name, 'glass' => $this->glass, 'drink_type' => $this->drink_type, 'description' => $this->description));

		$row = $query->fetch();

		$this->id = $row['id'];
	}

	public function update() {
		$query = DB::connection()->prepare('UPDATE Drink (name, glass, drink_type, description) VALUES (:name, :glass, :drink_type, :description) RETURNING id');

		$query->execute(array('name' => $this->name, 'glass' => $this->glass, 'drink_type' => $this->drink_type, 'description' => $this->description));

		$row = $query->fetch();
	}

	public fuction destroy() {
		$reference_query = DB::connection()->prepare('DELETE FROM Recipes WHERE drink = :id');
        $query = DB::connection()->prepare('DELETE FROM Drink WHERE id = :id');
        
        $reference_query->execute(array('id' => $this->id));
        $query->execute(array('id' => $this->id));
	}

	public function validate_name() {
		$errors = array();
		
		if ($this->validate_string_not_empty_or_null($this->name)) {
			$errors[] = 'Nimi ei saa olla tyhjä!';
		}

		if ($this->validate_string_length($this->name, 50)) {
			$errors[] = 'Nimi ei saa olla yli 50 merkkiä pitkä!';
		}
		return $errors;
	}

	public function validate_glass() {
		$errors = array();
		if ($this->validate_string_length($this->glass, 50)) {
			$errors[] = 'Lasin nimi ei saa olla yli 50 merkkiä pitkä!';
		}
		return $errors;
	}

	public function validate_drink_type() {
		$errors = array();
		if ($this->validate_string_length($this->drink_type, 50)) {
			$errors[] = 'Drinkin tyyppi ei saa olla yli 50 merkkiä pitkä!';
		}
		return $errors;
	}

	##Ihan vaan että on joku roti
	public function validate_description() {
		$errors = array();
		if ($this->validate_string_length($this->drink_type, 1000)) {
			$errors[] = 'Kuvailuun riittänee 1000 kirjainta, ystävä hyvä!';
		}
		return $errors;
	}


}
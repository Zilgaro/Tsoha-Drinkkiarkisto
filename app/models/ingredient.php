<?php
class Ingredient extends BaseModel {
	public $name, $description;

	public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_no_duplicate_names', 'validate_description');
    }

    public static function all() {
    	$query = DB::connection()->prepare('SELECT * FROM Ingredient');
    	$query->execute();
		$rows = $query->fetchAll();

		$ingredients = array();

		foreach($rows as $row) {
			$ingredients[] = new Ingredient(array(
				'name' => $row['name'],
				'description' => $row['description']
				));
		}

		return $ingredients;
    }

    public static function find($name) {

    $query = DB::connection()->prepare('SELECT * FROM Ingredient WHERE name = :name LIMIT 1');
    	$query->execute(array('name' => $name));
    	$row = $query->fetch();

    	if($row){
    		$drink = new Drink(array(
				'name' => $row['name'],
				'description' => $row['description']
				));
    		return $drink;
    	}
    	return null;
	}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Ingredient (name, description) VALUES (:name, :description)');
		$query->execute(array('name' => $this->name, 'description' => $this->description));
	}

	public function update() {
		 $query = DB::connection()->prepare('UPDATE Ingredient SET description = :description WHERE name = :name');
		 $query->execute(array('name' => $this->name, 'description' => $this->description));
	}


	public function validate_name() {
		$errors = array();

		$length = 50;

		if ($this->validate_string_not_empty_or_null($this->name)) {
			$errors[] = 'Nimi ei saa olla tyhjä!';
		}

		if ($this->validate_string_length($this->name, $length)) {
			$errors[] = 'Nimi saa olla vain ' . $length . ' merkkiä pitkä!';
		}

		$length = 2;

		if ($this->validate_string_brevity($this->name, $length)) {
			$errors[] = 'Nimen tulee olla ainakin ' . $length . ' merkkiä pitkä!';
		}
		return $errors;
	}

	public function validate_no_duplicate_names() {
		$errors = array();

		if (self::find($this->name) != null) {
			$errors[] = 'Samanniminen ainesosa löytyy jo!';
		}
		return $errors;
	}

	public function validate_description() {
		$errors = array();
		$length = 500;
		if ($this->validate_string_length($this->description, $length)) {
			$errors[] = 'Kuvailuun riittänee ' . $length . ' kirjainta, var så god!';
		}
		return $errors;
	}
}
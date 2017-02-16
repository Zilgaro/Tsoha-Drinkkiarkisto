<?php
class Ingredient extends BaseModel {
	public $name, $description;

	public function __construct($attributes) {
        parent::__construct($attributes);
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
}
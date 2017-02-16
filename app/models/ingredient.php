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
}
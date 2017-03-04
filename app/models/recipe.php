<?php

class Recipe extends BaseModel {
	public $name;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT i.name FROM Drink d JOIN Recipe r ON d.id = r.drink_id JOIN Ingredient i ON r.ingredient = i.name WHERE d.id = :id');
		$query->execute(array('id' => $id));

		$rows = $query->fetchAll();
		$recipe = array();

		foreach ($rows as $row) {
			$recipe[] = new Recipe(array(
				'name' => $row['name']
				));
		}
		return $recipe;
	}

	public static function findDrinksByIngredient($name) {
		$query = DB::connection()->prepare('SELECT d.name FROM Ingredient i JOIN Recipe r ON i.name = r.ingredient JOIN Drink d ON r.drink_id = d.id WHERE i.name = :name');
		$query->execute(array('name' => $name));

		$rows = $query->fetchAll();
		$recipe = array();

		foreach ($rows as $row) {
			$recipe[] = new Recipe(array(
				'name' => $row['name']
				));
		}

		return $recipe;
	}
}
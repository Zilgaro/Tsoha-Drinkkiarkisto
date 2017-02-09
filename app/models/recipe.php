<?php

class Recipe extends BaseModel {
	public $drink_id, $ingredient_id;

	public function __construct($attributes) {
		parent::__construct($attributes);
	}

	public static function find($drink_id) {
		//jotain
	}
}
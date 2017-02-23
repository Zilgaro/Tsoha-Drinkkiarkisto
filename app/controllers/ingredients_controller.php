<?php
class IngredientController extends BaseController {

	public static function index() {
		$ingredients = Ingredient::all();

		View::make('ingredient/ingredient_list.html', array('ingredients' => $ingredients));
	}

	public static function show($name) {
		$ingredient = Ingredient::find($name);
		//Voisi tehdä lopuksi niin että näytetään missä kaikissa drinkeissä mukana
		View::make('ingredient/ingredient_show.html', array('ingredient' => $ingredient));
	}

	public static function create() {
		View::make('ingredient/ingredient_new.html');
	}

	public static function store() {
		$params = $_POST;

		$attributes = array(
			'name' => $params['name'],
			'description' => $params['description']
			);
		$ingredient = new Ingredient($attributes);
		$errors = $ingredient->errors();

		if (count($errors) == 0) {
			$ingredient->save();

			Redirect::to('/ingredient/' . $ingredient->name, array('message' => 'Ainesosa lisättiin onnistuneesti!'));
		} else {
			View::make('ingredient/ingredient_new.html', array('errors' => $errors));
		}
	}

}
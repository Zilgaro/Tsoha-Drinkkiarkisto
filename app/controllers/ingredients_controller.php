<?php
class IngredientController extends BaseController {

	public static function index() {
		$ingredients = Ingredient::all();

		View::make('ingredient/ingredient_list.html', array('ingredients' => $ingredients));
	}

	public static function show($name) {
		$ingredient = Ingredient::find($name);
		//Voisi tehdä lopuksi niin että näytetään missä kaikissa drinkeissä mukana
		$drinks = Recipe::findDrinksByIngredient($name);

		View::make('ingredient/ingredient_show.html', array('ingredient' => $ingredient, 'drinks' => $drinks));
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
		$errors += $ingredient->validate_no_duplicate_names();

		if (count($errors) == 0) {
			$ingredient->save();

			Redirect::to('/ingredient/' . $ingredient->name, array('message' => 'Ainesosa lisättiin onnistuneesti!'));
		} else {
			View::make('ingredient/ingredient_new.html', array('errors' => $errors));
		}
	}

	public static function ingredient_edit($name) {
		$attributes = Ingredient::find($name);

		View::make('ingredient/ingredient_edit.html', array('attributes' => $attributes));
	}

	public static function update() {
		$params = $_POST;

		$attributes = array(
			'name' => $params['name'],
			'description' => $params['description']
		);

		$ingredient = new Ingredient($params);
		$errors = $ingredient->errors();

		if (count($errors) == 0) {
			$ingredient->update();

			Redirect::to('/ingredient/' . $ingredient->name, array('message' => 'Ainesosa päivitettiin onnistuneesti!'));
		} else {
			View::make('ingredient/ingredient_edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($name) {
		$ingredient = new Ingredient(array('name'=>$name));

		$ingredient->destroy();

		Redirect::to('/ingredient', array('message' => 'Aineososa poistettiin onnistuneesti!'));
	}
}
<?php 

class DrinkController extends BaseController{
	public static function index() {
		$drinks = Drink::all();

		View::make('drink/drink_list.html', array('drinks' => $drinks));
	}

	public static function show($id) {
		$drink = Drink::find($id);
		//Hae ainesosat myös reseptistä
		$recipe = Recipe::find($id);
		View::make('drink/drink_show.html', array('drink' => $drink, 'recipe' => $recipe));
	}

	public static function drink_edit($id) {
		$drink = Drink::find($id);
		$ingredients = Ingredient::all();

		View::make('drink/drink_edit.html', array('attributes' => $drink, 'ingredients' => $ingredients));
	}

	public static function update($id) {
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'name' => $params['name'],
			'glass' => $params['glass'],
			'drink_type' => $params['drink_type'],
			'description' => $params['description']
		);
		$ingredients = $params['ingredients'];
		$drink = new Drink($attributes);
		$errors = $drink->errors();

		if(count($errors) == 0) {
			$drink->update($ingredients);

			Redirect::to('/drink/'. $drink->id, array('message' => 'Drinkki päivitettiin onnistuneesti!'));
		} else {
			View::make('drink/drink_edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function create() {
		$ingredients = Ingredient::all();
		View::make('drink/new.html', array('ingredients' => $ingredients));
	} 

	public static function store() {
		$params = $_POST;

		$attributes = array(
			'name' => $params['name'],
			'glass' => $params['glass'],
			'drink_type' => $params['drink_type'],
			'description' => $params['description']
		);
		$ingredients = $params['ingredients'];
		$drink = new Drink($attributes);

		$errors = $drink->errors();

		if(count($errors) == 0) {
			$drink->save($ingredients);

			Redirect::to('/drink/'. $drink->id, array('message' => 'Drinkki on listätty arkistoon onnistuneesti!'));
		} else {
			View::make('drink/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}

	}

	public static function destroy($id) {
		$drink = new Drink(array('id'=>$id));

		$drink->destroy();

		Redirect::to('/drink', array('message' => 'Drinkki poistettiin onnistuneesti!'));
	}
}
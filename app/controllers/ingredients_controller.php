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
}
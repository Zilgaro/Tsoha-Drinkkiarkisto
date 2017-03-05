<?php 

class DrinkController extends BaseController {

	 //Mul menee hermo siihen etten tajuu miten saan noi drinkkityyppien ja lasityyppien listat sillai ettei tarvii hakee joka kerta uusiks, php on TYHMÄ, tai sit mä oon

	public static function index() {
		$drinks = Drink::all();

		View::make('drink/drink_list.html', array('drinks' => $drinks));
	}

	public static function show($id) {
		$drink = Drink::find($id);
		//Hae ainesosat myös reseptistä
		$recipe = Recipe::find($id);
		$rating = Rating::averageRatingsByDrinkId($id);
		View::make('drink/drink_show.html', array('drink' => $drink, 'recipe' => $recipe, 'rating' => $rating));
	}

	public static function drink_edit($id) {
		$drink = Drink::find($id);
		$ingredients = Ingredient::all();
		$GLASS_TYPES = Constants::getGlassTypes();
		$DRINK_TYPES = Constants::getDrinkTypes();

		View::make('drink/drink_edit.html', array('attributes' => $drink, 'drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES, 'ingredients' => $ingredients));
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

		$GLASS_TYPES = Constants::getGlassTypes();
		$DRINK_TYPES = Constants::getDrinkTypes();

		if (!isset($params['ingredients'])) {
			$ingredients = Ingredient::all();
			$errors = array();
			$errors[] = 'Valitse ainakin yksi ainesosa!';
			View::make('drink/drink_edit.html', array('errors' => $errors, 'attributes' => $attributes, 'ingredients' => $ingredients, 'drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES));
		}

		$ingredients = $params['ingredients'];
		$drink = new Drink($attributes);
		$errors = $drink->errors();

		if(count($errors) == 0) {
			$drink->update($ingredients);

			Redirect::to('/drink/'. $drink->id, array('message' => 'Drinkki päivitettiin onnistuneesti!'));
		} else {
			$ingredients = Ingredient::all();
			View::make('drink/drink_edit.html', array('errors' => $errors, 'drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES, 'attributes' => $attributes, 'ingredients' => $ingredients));
		}
	}

	public static function create() {
		$ingredients = Ingredient::all();
		$GLASS_TYPES = Constants::getGlassTypes();
		$DRINK_TYPES = Constants::getDrinkTypes();
		View::make('drink/new.html', array('drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES, 'ingredients' => $ingredients));
	} 

	public static function store() {
		$params = $_POST;

		$attributes = array(
			'name' => $params['name'],
			'glass' => $params['glass'],
			'drink_type' => $params['drink_type'],
			'description' => $params['description']
		);

		if (!isset($params['ingredients'])) {
			$ingredients = Ingredient::all();
			$GLASS_TYPES = Constants::getGlassTypes();
			$DRINK_TYPES = Constants::getDrinkTypes();
			$errors = array();
			$errors[] = 'Valitse ainakin yksi ainesosa!';
			View::make('drink/new.html', array('errors' => $errors, 'drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES, 'attributes' => $attributes, 'ingredients' => $ingredients));
		}

		$ingredients = $params['ingredients'];
		$drink = new Drink($attributes);

		$errors = $drink->errors();

		if(count($errors) == 0) {
			$drink->save($ingredients);

			Redirect::to('/drink/'. $drink->id, array('message' => 'Drinkki on listätty arkistoon onnistuneesti!'));
		} else {
			$GLASS_TYPES = Constants::getGlassTypes();
			$DRINK_TYPES = Constants::getDrinkTypes();
			View::make('drink/new.html', array('errors' => $errors, 'drinktypes' => $DRINK_TYPES, 'glasstypes' => $GLASS_TYPES, 'attributes' => $attributes));
		}

	}

	public static function destroy($id) {
		$drink = new Drink(array('id'=>$id));

		$drink->destroy();

		Redirect::to('/drink', array('message' => 'Drinkki poistettiin onnistuneesti!'));
	}

	//pitäs oikeesti varmaa olla oma kontrolleri mut emt
	public static function rate($drink) {
		$params = $_POST;
		$client = $_SESSION['user'];

		$attributes = array(
			'client' => $client,
			'drink' => $drink,
			'rating' => $params['rating']
		);

		$rating = new Rating($attributes);

		if ($rating->check_if_exists_rating_by_client()) {
			$rating->update();
			Redirect::to('/drink/' . $drink, array('message' => 'Arvostelu päivitetty onnistuneesti!'));
		} else {
			$rating->save();

			Redirect::to('/drink/' . $drink, array('message' => 'Arvostelu lisätty onnistuneesti!'));
		}
	}
}
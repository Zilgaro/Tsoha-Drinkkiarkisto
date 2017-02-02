<?php 

class DrinkController extends BaseController{
	public static function index() {
		$drinks = Drink::all();

		View::make('drink/drink_list.html', array('drinks' => $drinks));
	}

	public static function show($id) {
		$drink = Drink::find($id);
		//Hae ainesosat myös reseptistä
		View::make('drink/drink_show.html', array('drink' => $drink));
	}

	public static function create() {
		View::make('drink/new.html');
	} 

	public static function store() {
		$params = $_POST;

		$drink = new Drink(array(
			'name' => $params['name'],
			'glass' => $params['glass'],
			'drink_type' => $params['drink_type'],
			'description' => $params['description']
		));

		$drink->save();

		Redirect::to('/drink/'. $drink->id, array('message' => 'Drinkki on lisätty arkistoon!'));
	}
}
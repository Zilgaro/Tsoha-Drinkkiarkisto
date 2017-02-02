<?php 

class DrinkController extends BaseController{
	public static function index() {
		$drinks = Drink::all();

		View::make('drink/drink_list.html', array('drinks' => $drinks));
	}

	public static function show($id) {
		$drink = Drink:find($id);

		View::make('drink/drink_show.html', $drink);
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
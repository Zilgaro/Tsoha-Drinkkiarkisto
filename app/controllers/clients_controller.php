<?php

class ClientController extends BaseController {
	public static function login() {
		View::make('client/login.html');
	}

	public static function handle_login() {
		$params = $_POST;

		$client = Client::authenticate($params['name'], $params['password']);

		if (!$client) {
			View::make('client/login.html', array('error' => 'Väärä käyttäjatunnus ja/tai salasana!', 'name' => $params['name']));
		} else {
			$_SESSION['user'] = $client->id;

			Redirect::to('/drink', array('message' => 'Tervetuloa takaisin ' . $client->name . '!'));
		}  
	}
}
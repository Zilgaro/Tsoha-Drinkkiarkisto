<?php

class ClientController extends BaseController {
	public static function login() {
		View::make('client/login.html');
	}

	public static function register() {
		View::make('client/register.html');
	}

	public static function list_clients() {
		$user_id = $_SESSION['user'];

		if (!Client::checkAdmin($user_id)) {
			Redirect::to('/drink', array('message' => 'PÄÄSY KIELLETTY'));
		}

		$clients = Client::all();

		View::make('client/list_clients.html', array('clients' => $clients));
	}

	public static function handle_login() {
		$params = $_POST;

		$client = Client::authenticate($params['name'], $params['password']);

		if (!$client) {
			View::make('client/login.html', array('errorMessage' => 'Väärä käyttäjatunnus ja/tai salasana!', 'name' => $params['name']));
		} else {
			$_SESSION['user'] = $client->id;

			Redirect::to('/drink', array('message' => 'Tervetuloa takaisin ' . $client->name . '!'));
		}  
	}

	public static function create() { //Store parempi nimi?
		$params = $_POST;
		$errors = array();

		if (Client::checkAvailable($params['name'])) { // tää pitäs siirtää modelii
			$client = new Client(array(
				'name' => $params['name'],
				'password' => $params['password'],
				'admin' => FALSE
			));


			$errors = $client->errors();
			if ($params['password'] != $params['passwordAgain']) {
				$errors[] = 'Salasanat eivät ole samat!';
			}
			if(count($errors) == 0) {
				$client->save();
				Redirect::to('/login', array('message' => 'Käyttäjatunnus luotiin onnistuneesti, kirjaudu sisään!'));	
			} else {
				View::make('client/register.html', array('errors' => $errors));
			}
		} else {
			View::make('client/register.html', array('errorMessage' => 'Käyttäjatunnus on jo käytössä!'));
		}
	}

	public static function logout() {
		$_SESSION['user'] = null;
		Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
	}
}
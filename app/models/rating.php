<?php

class Rating extends BaseModel {
		public $client, $drink, $rating;

		public function __construct($attributes) {
			parent::__construct($attributes);
		}

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Rating (client, drink, rating) VALUES (:client, :drink, :rating)');
		$query->execute(array('client' => $this->client, 'drink' => $this->drink, 'rating' => $this->rating));

	}

	public function update() {
		$query = DB::connection()->prepare('UPDATE Rating SET rating = :rating WHERE client = :client AND drink = :drink');
		$query->execute(array('client'=> $this->client, 'drink' => $this->drink, 'rating' => $this->rating));
	}

	public static function averageRatingsByDrinkId($id) {
		$query = DB::connection()->prepare('SELECT rating FROM Rating WHERE drink = :id');

		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		$average = 0;

		foreach ($rows as $row) {
			$average += $row['rating'];
		}

		if ($average != null) {
			$average = $average / count($rows);
		}

		return $average;
	}

	public function check_if_exists_rating_by_client() {
		$query = DB::connection()->prepare('SELECT rating FROM Rating WHERE client = :client AND drink = :drink LIMIT 1');
		$query->execute(array('client' => $this->client, 'drink' => $this->drink));
		$row = $query->fetch();

		if($row) {
			return true;
		}
		return false;

	}
}
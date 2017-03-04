<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])) {
        $client_id = $_SESSION['user'];

        $client = Client::find($client_id);

        return $client;
      }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

      if(!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Et ole kirjautunut sisään'));
        }
    }
  }
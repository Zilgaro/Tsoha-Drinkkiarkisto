<?php

  class BaseController{

    public static function get_client_logged_in(){
      if(isset($_SESSION['client'])) {
        $client_id = $_SESSION['client'];

        $client = Client::find($client_id);

        return $client;
      }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }

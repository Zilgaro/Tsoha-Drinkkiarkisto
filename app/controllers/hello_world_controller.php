<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      $kak = new Drink(array(
        'name' => '',
        'glass' => 'asklfhawdhfklsdhfasdhfjhdjfhsdhfdhsjlfhdsjlghjlshgjlsdhgjlsdgklsdhgklsdjgkljsdgkljsdgkl',
        'drink_type' => 'kldfklasdklasdkgsfksjkgnasdklgsklsdklnklasdnklnkldnvklsdnvklasdnsdnvklsdnvklsdnklsdnvklsdnvklsndnsdklvnsdnvsdlnvsdklnvsdklvsdklnvklsdnvklsdnvklsdnklvsdnvklsdnvkln',
        'description' => 'AIKA HASU!'
        ));
        $errors = $kak->errors();

        Kint::dump($errors);
    }

    public static function drink_list() {
      View::make('drink_list.html');
    }

    public static function drink_show() {
      View::make('drink_show.html');
    }

    public static function drink_edit() {
      View::make('drink_edit.html');
    }

    public static function login() {
      View::make('login.html');
    }
  }
